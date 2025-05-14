<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LandingPageTest extends DuskTestCase
{
    /** @test TC.LandingPage.001 */
    public function testLandingPageLoadsCorrectlyAndIsResponsive()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('FloodRescue')
                ->assertSee('Bantuan Darurat')
                ->assertSee('Artikel & Edukasi')
                ->resize(375, 812) // iPhone X resolution
                ->assertVisible('.flex') // Pastikan layout tidak rusak di mobile
                ->screenshot('landing_responsive_check');
        });
    }

    /** @test TC.LandingPage.002 */
    public function testCTAButtonNavigatesCorrectly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Artikel & Edukasi') // Tombol CTA ke Artikel
                ->assertPathIs('/articles') // Pastikan redirect ke halaman artikel
                ->screenshot('cta_articles_button');
        });
    }

    /** @test TC.LandingPage.003 (1) */
    public function testNavbarResponsiveInMobile()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->resize(375, 812) // Mobile resolution
                ->click('#navbar-toggle') // Buka menu navbar
                ->pause(500) // Tunggu animasi
                ->assertVisible('#navbar-menu')
                ->assertSee('Form Laporan Banjir')
                ->screenshot('navbar_mobile_responsive');
        });
    }

    /** @test TC.LandingPage.003 (2) */
    public function testLogoAndAnimationAreVisible()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertPresent('img[alt="Logo"]') // Logo FloodRescue
                ->assertPresent('dotlottie-player') // Pastikan animasi Lottie muncul
                ->screenshot('logo_and_visual_check');
        });
    }
}
