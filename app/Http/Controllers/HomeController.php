public function index()
{
    $services = [
        ['icon' => 'fas fa-water', 'title' => 'Water Removal', 'description' => 'Swift and efficient water extraction'],
        ['icon' => 'fas fa-broom', 'title' => 'Debris Cleanup', 'description' => 'Complete removal of flood debris'],
        ['icon' => 'fas fa-spray-can', 'title' => 'Sanitization', 'description' => 'Professional sanitization services']
    ];

    $benefits = [
        ['icon' => 'fas fa-bolt', 'title' => '24/7 Response', 'description' => 'Always ready to help'],
        ['icon' => 'fas fa-certificate', 'title' => 'Certified Team', 'description' => 'Expert professionals'],
        ['icon' => 'fas fa-dollar-sign', 'title' => 'Affordable', 'description' => 'Competitive pricing'],
        ['icon' => 'fas fa-leaf', 'title' => 'Eco-Friendly', 'description' => 'Green cleaning solutions']
    ];

    return view('home', compact('services', 'benefits'));
}