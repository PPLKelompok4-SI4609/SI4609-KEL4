<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy; // Pastikan ini ada

class BantuanDaruratTest extends DuskTestCase
{
    /**
     * Test untuk memastikan halaman bantuan darurat bisa diakses setelah login
     * dan elemen-elemen utama terlihat.
     *
     * @return void
     */
    public function testHalamanBantuanDaruratAccessibleAndElementsVisible()
    {
        $this->browse(function (Browser $browser) {
            // Langsung login sebagai user yang sudah ada
            $user = User::where('email', 'abid.naufal2003@gmail.com')->first();
            $browser->loginAs($user);

            // Kunjungi route sementara untuk menyetel session 'two_factor_verified'
            $browser->visit(route('dusk.set-session'))
                    ->assertSee('Session set!')
                    ->pause(500); // Jeda singkat setelah session disetel

            // Kunjungi halaman root, yang akan redirect ke /home setelah countdown
            $browser->visit('/')
                    ->pause(7000) // Jeda 7 detik (5s countdown + 2s buffer)
                    ->waitForText('FloodRescue', 10) // Pastikan teks 'FloodRescue' di home page muncul
                    ->assertAuthenticated()
                    ->pause(2500); // Jeda 2.5 detik untuk memastikan semua elemen home fully rendered

            // Setelah login dan di home page, klik tombol "Bantuan Darurat"
            $browser->waitFor('.flex.flex-wrap.gap-4 a[href="/bantuan-darurat"]', 10)
                    ->click('.flex.flex-wrap.gap-4 a[href="/bantuan-darurat"]'); // Ini sudah benar untuk CSS Selector

            // Kunjungi Halaman Bantuan Darurat
            $browser->waitForText('Halaman Bantuan Darurat', 10) // Tunggu teks judul muncul
                    ->assertPathIs('/bantuan-darurat') // Pastikan path URL sudah benar
                    ->pause(2500) // Jeda 2.5 detik, untuk memastikan semua kartu kontak fully rendered
                    ->assertSee('Polrestabes Bandung')
                    ->assertSee('BPBD Kota Bandung')
                    ->assertSee('Damkar Kota Bandung')
                    ->assertSee('Puskesmas Dago')
                    ->assertSee('PLN UP3 Bandung')
                    ->assertSee('Bandung Bergerak')
                    ->assertSeeLink('WhatsApp')
                    ->assertSeeLink('Instagram')
                    ->assertSeeLink('Hubungi 113')
                    ->assertSourceHas('<a href="https://wa.me/6281222223333" target="_blank" class="btn">WhatsApp</a>');
        });
    }

    /**
     * Test untuk memastikan tombol WhatsApp berfungsi dengan benar.
     *
     * @return void
     */
    public function testWhatsAppButtonRedirectsCorrectly()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('email', 'abid.naufal2003@gmail.com')->first();
            $browser->loginAs($user);
            $browser->visit(route('dusk.set-session'))
                    ->assertSee('Session set!')
                    ->pause(500);

            $browser->visit('/')
                    ->pause(7000)
                    ->waitForText('FloodRescue', 10)
                    ->assertAuthenticated()
                    ->pause(2500);

            $browser->waitFor('.flex.flex-wrap.gap-4 a[href="/bantuan-darurat"]', 10)
                    ->click('.flex.flex-wrap.gap-4 a[href="/bantuan-darurat"]');

            $browser->waitForText('Halaman Bantuan Darurat', 10)
                    ->assertPathIs('/bantuan-darurat')
                    ->pause(2500);

            $browser->pause(1000)
                    // <<-- UBAH BAGIAN INI UNTUK KLIK VIA XPATH SECARA EKSPLISIT
                    ->driver->findElement(WebDriverBy::xpath(
                        "//div[contains(@class, 'profile-card') and .//h2[contains(text(), 'Polrestabes Bandung')]]//a[text()='WhatsApp']"
                    ))->click();
                    // <<-- SAMPAI SINI
            $browser->assertSourceHas('https://wa.me/6281222223333');
        });
    }

    /**
     * Test untuk memastikan tombol Instagram berfungsi dengan benar.
     *
     * @return void
     */
    public function testInstagramButtonRedirectsCorrectly()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('email', 'abid.naufal2003@gmail.com')->first();
            $browser->loginAs($user);
            $browser->visit(route('dusk.set-session'))
                    ->assertSee('Session set!')
                    ->pause(500);

            $browser->visit('/')
                    ->pause(7000)
                    ->waitForText('FloodRescue', 10)
                    ->assertAuthenticated()
                    ->pause(2500);

            $browser->waitFor('.flex.flex-wrap.gap-4 a[href="/bantuan-darurat"]', 10)
                    ->click('.flex.flex-wrap.gap-4 a[href="/bantuan-darurat"]');

            $browser->waitForText('Halaman Bantuan Darurat', 10)
                    ->assertPathIs('/bantuan-darurat')
                    ->pause(2500);

            $browser->pause(1000)
                    // <<-- UBAH BAGIAN INI
                    ->driver->findElement(WebDriverBy::xpath(
                        "//div[contains(@class, 'profile-card') and .//h2[contains(text(), 'Polrestabes Bandung')]]//a[text()='Instagram']"
                    ))->click();
                    // <<-- SAMPAI SINI
            $browser->assertSourceHas('https://instagram.com/polrestabesbandung');
        });
    }

    /**
     * Test untuk memastikan tombol "Hubungi 113" Damkar berfungsi dengan benar.
     *
     * @return void
     */
    public function testCallButtonDamkarRedirectsCorrectly()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('email', 'abid.naufal2003@gmail.com')->first();
            $browser->loginAs($user);
            $browser->visit(route('dusk.set-session'))
                    ->assertSee('Session set!')
                    ->pause(500);

            $browser->visit('/')
                    ->pause(7000)
                    ->waitForText('FloodRescue', 10)
                    ->assertAuthenticated()
                    ->pause(2500);

            $browser->waitFor('.flex.flex-wrap.gap-4 a[href="/bantuan-darurat"]', 10)
                    ->click('.flex.flex-wrap.gap-4 a[href="/bantuan-darurat"]');

            $browser->waitForText('Halaman Bantuan Darurat', 10)
                    ->assertPathIs('/bantuan-darurat')
                    ->pause(2500);

            $browser->pause(1000)
                    // <<-- UBAH BAGIAN INI
                    ->driver->findElement(WebDriverBy::xpath(
                        "//div[contains(@class, 'profile-card') and .//h2[contains(text(), 'Damkar Kota Bandung')]]//a[text()='Hubungi 113']"
                    ))->click();
                    // <<-- SAMPAI SINI
            $browser->assertSourceHas('tel:113');
        });
    }
}