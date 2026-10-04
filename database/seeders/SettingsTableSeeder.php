<?php
// database/seeders/SettingsTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            // Company Information
            [
                'key' => 'company_name',
                'value' => 'Plante Pharma',
                'type' => 'text',
                'group' => 'company',
                'description' => 'Company name',
            ],
            [
                'key' => 'company_email',
                'value' => 'info@plantepharma.eu',
                'type' => 'email',
                'group' => 'company',
                'description' => 'Main company email address',
            ],
            [
                'key' => 'company_phone',
                'value' => '',
                'type' => 'text',
                'group' => 'company',
                'description' => 'Company phone number',
            ],
            [
                'key' => 'company_address',
                'value' => '',
                'type' => 'textarea',
                'group' => 'company',
                'description' => 'Company physical address',
            ],

            // Contact Information
            [
                'key' => 'contact_email',
                'value' => 'info@plantepharma.eu',
                'type' => 'email',
                'group' => 'contact',
                'description' => 'Contact form recipient email',
            ],
            [
                'key' => 'contact_description_en',
                'value' => 'Plante Pharma is growing fast and we are looking to expand our network of distributors worldwide. We want to develop a real partnership with each distributor, offering them a line of Ready-to-market products, with all the technical, commercial and marketing support needed to ensure their success.',
                'type' => 'textarea',
                'group' => 'contact',
                'description' => 'Contact section description (English)',
            ],
            [
                'key' => 'contact_description_es',
                'value' => 'Plante Pharma está creciendo rápidamente y estamos buscando expandir nuestra red de distribuidores en todo el mundo. Queremos desarrollar una asociación real con cada distribuidor, ofreciéndoles una línea de productos listos para el mercado, con todo el soporte técnico, comercial y de marketing necesario para garantizar su éxito.',
                'type' => 'textarea',
                'group' => 'contact',
                'description' => 'Contact section description (Spanish)',
            ],

            // Images
            [
                'key' => 'logo',
                'value' => 'images/logo.png',
                'type' => 'image',
                'group' => 'images',
                'description' => 'Company logo',
            ],
            [
                'key' => 'favicon',
                'value' => 'images/logo.png',
                'type' => 'image',
                'group' => 'images',
                'description' => 'Website favicon',
            ],

            // Hero Section Settings
            [
                'key' => 'hero_title_en',
                'value' => 'Welcome to Plante Pharma',
                'type' => 'text',
                'group' => 'hero',
                'description' => 'Hero section title (English)',
            ],
            [
                'key' => 'hero_title_es',
                'value' => 'Bienvenido a Plante Pharma',
                'type' => 'text',
                'group' => 'hero',
                'description' => 'Hero section title (Spanish)',
            ],
            [
                'key' => 'hero_button_en',
                'value' => 'About Plante Pharma',
                'type' => 'text',
                'group' => 'hero',
                'description' => 'Hero section button text (English)',
            ],
            [
                'key' => 'hero_button_es',
                'value' => 'Sobre Plante Pharma',
                'type' => 'text',
                'group' => 'hero',
                'description' => 'Hero section button text (Spanish)',
            ],

            // About Section Settings
            [
                'key' => 'about_title_en',
                'value' => 'About Plante Pharma',
                'type' => 'text',
                'group' => 'about',
                'description' => 'About section main title (English)',
            ],
            [
                'key' => 'about_title_es',
                'value' => 'Sobre Plante Pharma',
                'type' => 'text',
                'group' => 'about',
                'description' => 'About section main title (Spanish)',
            ],
            [
                'key' => 'about_description_en',
                'value' => 'Plante Pharma is a producer of Medicine and dietary supplements, intended for sale only in pharmacies. From the beginning of our activity in the pharmaceutical market, we focus on innovation and the effectiveness of recipes and products. Our manufacturing site offers advanced capabilities and a rich technological experience where everyday a team of committed and competent employees work to develop and manufacture safe and efficient pharmaceutical products. Innovation, the highest quality and effective operation of products are always key issues for us.',
                'type' => 'textarea',
                'group' => 'about',
                'description' => 'Main about description text (English)',
            ],
            [
                'key' => 'about_description_es',
                'value' => 'Plante Pharma es un productor de medicamentos y suplementos dietéticos, destinados a la venta exclusiva en farmacias. Desde el inicio de nuestra actividad en el mercado farmacéutico, nos enfocamos en la innovación y la efectividad de las recetas y productos. Nuestro sitio de fabricación ofrece capacidades avanzadas y una rica experiencia tecnológica donde todos los días un equipo de empleados comprometidos y competentes trabaja para desarrollar y fabricar productos farmacéuticos seguros y eficientes. La innovación, la más alta calidad y el funcionamiento efectivo de los productos son siempre cuestiones clave para nosotros.',
                'type' => 'textarea',
                'group' => 'about',
                'description' => 'Main about description text (Spanish)',
            ],
            [
                'key' => 'about_image',
                'value' => 'images/logo.png',
                'type' => 'image',
                'group' => 'about',
                'description' => 'About section image',
            ],

            // Mission Section
            [
                'key' => 'mission_title_en',
                'value' => 'Our Mission & Vision',
                'type' => 'text',
                'group' => 'about',
                'description' => 'Mission and vision section title (English)',
            ],
            [
                'key' => 'mission_title_es',
                'value' => 'Nuestra Misión y Visión',
                'type' => 'text',
                'group' => 'about',
                'description' => 'Mission and vision section title (Spanish)',
            ],
            [
                'key' => 'mission_description_en',
                'value' => 'Always offer a premium and effective product in the health segment at prices affordable to everyone, including proper advice guaranteeing optimal results. Our mission is to acquire and maintain a stable and constantly expanding group of satisfied customers that bring profit to the Company and maintain a stable market position as a large, professional and reliable producer of cosmetics popular on the world market, with particular emphasis on the European Union market.',
                'type' => 'textarea',
                'group' => 'about',
                'description' => 'Mission and vision description (English)',
            ],
            [
                'key' => 'mission_description_es',
                'value' => 'Ofrecer siempre un producto premium y efectivo en el segmento de la salud a precios asequibles para todos, incluyendo el asesoramiento adecuado que garantice resultados óptimos. Nuestra misión es adquirir y mantener un grupo estable y en constante expansión de clientes satisfechos que generen ganancias para la Compañía y mantengan una posición estable en el mercado como un productor grande, profesional y confiable de cosméticos populares en el mercado mundial, con especial énfasis en el mercado de la Unión Europea.',
                'type' => 'textarea',
                'group' => 'about',
                'description' => 'Mission and vision description (Spanish)',
            ],

            // Why Choose Us Section
            [
                'key' => 'why_choose_title_en',
                'value' => 'Why Choose us?',
                'type' => 'text',
                'group' => 'about',
                'description' => 'Why choose us section title (English)',
            ],
            [
                'key' => 'why_choose_title_es',
                'value' => '¿Por qué elegirnos?',
                'type' => 'text',
                'group' => 'about',
                'description' => 'Why choose us section title (Spanish)',
            ],
            [
                'key' => 'why_choose_description_en',
                'value' => 'Plante Pharma products have an effective formulation and innovative combination of ingredients. The selection of raw materials is based on their purity and safety. All active ingredients are highly bioavailable and clinically tested with a determined mechanism of action. Quality & Regulatory Compliance is a core value of our company implemented at all the levels, from the manufacturing to the delivery of our products.',
                'type' => 'textarea',
                'group' => 'about',
                'description' => 'Why choose us description (English)',
            ],
            [
                'key' => 'why_choose_description_es',
                'value' => 'Los productos de Plante Pharma tienen una formulación efectiva y una combinación innovadora de ingredientes. La selección de materias primas se basa en su pureza y seguridad. Todos los ingredientes activos son altamente biodisponibles y clínicamente probados con un mecanismo de acción determinado. El cumplimiento de calidad y normativas es un valor fundamental de nuestra empresa implementado en todos los niveles, desde la fabricación hasta la entrega de nuestros productos.',
                'type' => 'textarea',
                'group' => 'about',
                'description' => 'Why choose us description (Spanish)',
            ],

            // Values Section
            [
                'key' => 'values_title_en',
                'value' => 'Our Values',
                'type' => 'text',
                'group' => 'about',
                'description' => 'Our values section title (English)',
            ],
            [
                'key' => 'values_title_es',
                'value' => 'Nuestros Valores',
                'type' => 'text',
                'group' => 'about',
                'description' => 'Our values section title (Spanish)',
            ],
            [
                'key' => 'values_description_en',
                'value' => 'To treat every employee with dignity & respect and create a culture of continuous learning & growth. To develop a long term & transparent relationship with our business associates by entering into value added ventures which are mutually beneficial. To share the benefits of our success with the communities and be socially responsible. To nurture talent & enhance teamwork.',
                'type' => 'textarea',
                'group' => 'about',
                'description' => 'Our values description (English)',
            ],
            [
                'key' => 'values_description_es',
                'value' => 'Tratar a cada empleado con dignidad y respeto y crear una cultura de aprendizaje y crecimiento continuo. Desarrollar relaciones a largo plazo y transparentes con nuestros socios comerciales mediante la participación en empresas de valor agregado que sean mutuamente beneficiosas. Compartir los beneficios de nuestro éxito con las comunidades y ser socialmente responsables. Fomentar el talento y mejorar el trabajo en equipo.',
                'type' => 'textarea',
                'group' => 'about',
                'description' => 'Our values description (Spanish)',
            ],

            // Quality Assurance Section
            [
                'key' => 'quality_title_en',
                'value' => 'Quality Assurance',
                'type' => 'text',
                'group' => 'quality',
                'description' => 'Quality section main title (English)',
            ],
            [
                'key' => 'quality_title_es',
                'value' => 'Garantía de Calidad',
                'type' => 'text',
                'group' => 'quality',
                'description' => 'Quality section main title (Spanish)',
            ],

            // Strategy Card
            [
                'key' => 'strategy_image',
                'value' => 'uploads/1111.jpg',
                'type' => 'image',
                'group' => 'quality',
                'description' => 'Strategy card image',
            ],
            [
                'key' => 'strategy_title_en',
                'value' => 'Strategy',
                'type' => 'text',
                'group' => 'quality',
                'description' => 'Strategy card title (English)',
            ],
            [
                'key' => 'strategy_title_es',
                'value' => 'Estrategia',
                'type' => 'text',
                'group' => 'quality',
                'description' => 'Strategy card title (Spanish)',
            ],
            [
                'key' => 'strategy_description_en',
                'value' => 'Product – choose the right product within the health group, offering the highest quality at fair and affordable prices',
                'type' => 'textarea',
                'group' => 'quality',
                'description' => 'Strategy card description (English)',
            ],
            [
                'key' => 'strategy_description_es',
                'value' => 'Producto – elegir el producto adecuado dentro del grupo de salud, ofreciendo la más alta calidad a precios justos y asequibles',
                'type' => 'textarea',
                'group' => 'quality',
                'description' => 'Strategy card description (Spanish)',
            ],
            [
                'key' => 'strategy_link',
                'value' => 'quality.html',
                'type' => 'text',
                'group' => 'quality',
                'description' => 'Strategy card read more link',
            ],

            // Quality Card
            [
                'key' => 'quality_card_image',
                'value' => 'uploads/blog-02.jpg',
                'type' => 'image',
                'group' => 'quality',
                'description' => 'Quality card image',
            ],
            [
                'key' => 'quality_card_title_en',
                'value' => 'Quality',
                'type' => 'text',
                'group' => 'quality',
                'description' => 'Quality card title (English)',
            ],
            [
                'key' => 'quality_card_title_es',
                'value' => 'Calidad',
                'type' => 'text',
                'group' => 'quality',
                'description' => 'Quality card title (Spanish)',
            ],
            [
                'key' => 'quality_card_description_en',
                'value' => 'Plante Pharma products have an effective formulation and innovative combination of ingredients.',
                'type' => 'textarea',
                'group' => 'quality',
                'description' => 'Quality card description (English)',
            ],
            [
                'key' => 'quality_card_description_es',
                'value' => 'Los productos de Plante Pharma tienen una formulación efectiva y una combinación innovadora de ingredientes.',
                'type' => 'textarea',
                'group' => 'quality',
                'description' => 'Quality card description (Spanish)',
            ],
            [
                'key' => 'quality_card_link',
                'value' => 'quality.html',
                'type' => 'text',
                'group' => 'quality',
                'description' => 'Quality card read more link',
            ],

            // Manufacturing Card
            [
                'key' => 'manufacturing_image',
                'value' => 'uploads/blog-03.jpg',
                'type' => 'image',
                'group' => 'quality',
                'description' => 'Manufacturing card image',
            ],
            [
                'key' => 'manufacturing_title_en',
                'value' => 'Manufacturing',
                'type' => 'text',
                'group' => 'quality',
                'description' => 'Manufacturing card title (English)',
            ],
            [
                'key' => 'manufacturing_title_es',
                'value' => 'Fabricación',
                'type' => 'text',
                'group' => 'quality',
                'description' => 'Manufacturing card title (Spanish)',
            ],
            [
                'key' => 'manufacturing_description_en',
                'value' => 'All our products are manufactured in the EU under GMP standards using top quality manufacturing equipment and strict quality control.',
                'type' => 'textarea',
                'group' => 'quality',
                'description' => 'Manufacturing card description (English)',
            ],
            [
                'key' => 'manufacturing_description_es',
                'value' => 'Todos nuestros productos son fabricados en la UE bajo estándares GMP utilizando equipos de fabricación de primera calidad y control de calidad estricto.',
                'type' => 'textarea',
                'group' => 'quality',
                'description' => 'Manufacturing card description (Spanish)',
            ],
            [
                'key' => 'manufacturing_link',
                'value' => 'quality.html',
                'type' => 'text',
                'group' => 'quality',
                'description' => 'Manufacturing card read more link',
            ],

            // Navigation Labels
            [
                'key' => 'nav_home_en',
                'value' => 'Home',
                'type' => 'text',
                'group' => 'navigation',
                'description' => 'Navigation home label (English)',
            ],
            [
                'key' => 'nav_home_es',
                'value' => 'Inicio',
                'type' => 'text',
                'group' => 'navigation',
                'description' => 'Navigation home label (Spanish)',
            ],
            [
                'key' => 'nav_about_en',
                'value' => 'About Us',
                'type' => 'text',
                'group' => 'navigation',
                'description' => 'Navigation about label (English)',
            ],
            [
                'key' => 'nav_about_es',
                'value' => 'Sobre Nosotros',
                'type' => 'text',
                'group' => 'navigation',
                'description' => 'Navigation about label (Spanish)',
            ],
            [
                'key' => 'nav_partner_en',
                'value' => 'Partner',
                'type' => 'text',
                'group' => 'navigation',
                'description' => 'Navigation partner label (English)',
            ],
            [
                'key' => 'nav_partner_es',
                'value' => 'Socio',
                'type' => 'text',
                'group' => 'navigation',
                'description' => 'Navigation partner label (Spanish)',
            ],
            [
                'key' => 'nav_quality_en',
                'value' => 'Quality',
                'type' => 'text',
                'group' => 'navigation',
                'description' => 'Navigation quality label (English)',
            ],
            [
                'key' => 'nav_quality_es',
                'value' => 'Calidad',
                'type' => 'text',
                'group' => 'navigation',
                'description' => 'Navigation quality label (Spanish)',
            ],
            [
                'key' => 'nav_contact_en',
                'value' => 'Contact Us',
                'type' => 'text',
                'group' => 'navigation',
                'description' => 'Navigation contact label (English)',
            ],
            [
                'key' => 'nav_contact_es',
                'value' => 'Contáctenos',
                'type' => 'text',
                'group' => 'navigation',
                'description' => 'Navigation contact label (Spanish)',
            ],
            [
                'key' => 'nav_categories_en',
                'value' => 'Categories',
                'type' => 'text',
                'group' => 'navigation',
                'description' => 'Navigation categories label (English)',
            ],
            [
                'key' => 'nav_categories_es',
                'value' => 'Categorías',
                'type' => 'text',
                'group' => 'navigation',
                'description' => 'Navigation categories label (Spanish)',
            ],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('Multilingual settings seeded successfully!');
    }
}
