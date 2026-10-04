<?php

namespace App\Http\Controllers;
use App\Models\Slide;
use App\Models\Setting;
use App\Models\Item;
use App\Models\Partner;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function index()
    {
        // Get all settings and items for the frontend
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        $items = Item::where('is_active', true)->get();
        $partners = Partner::active()->ordered()->get();

        $slides = Slide::active()->ordered()->get();

        return view('menu.index', compact('settings', 'items', 'partners', 'slides'));
    }

    public function getSlides()
    {
        $slides = Slide::active()
            ->ordered()
            ->get()
            ->map(function($slide) {
                return [
                    'id' => $slide->id,
                    'title' => $slide->title,
                    'description' => $slide->description,
                    'image' => $this->getImageUrl($slide->image),
                    'button_text' => $slide->button_text,
                    'button_link' => $slide->button_link,
                    'order' => $slide->order
                ];
            });

        return response()->json([
            'success' => true,
            'slides' => $slides
        ]);
    }
    public function getProducts()
    {
        $items = Item::where('is_active', true)
            ->with('category')
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'trade_name' => $item->name_en, // Using name_en as trade name
                    'form' => 'Vial', // Default form since it's not in your model
                    'packaging' => '1 Vial', // Default packaging
                    'composition' => $item->description, // Using description as composition
                    'image' => $item->cover_image_url,
                    'category_id' => $item->category_id,
                    'category_name' => $item->category->name ?? 'Uncategorized',
                    'normal_price' => $item->normal_price,
                    'currency' => $item->currency
                ];
            });

        return response()->json([
            'success' => true,
            'products' => $items
        ]);
    }

    public function getProduct($id)
    {
        $item = Item::with('category')->findOrFail($id);

        return response()->json([
            'success' => true,
            'product' => [
                'id' => $item->id,
                'name' => $item->name,
                'trade_name' => $item->name_en,
                'form' => 'Vial',
                'packaging' => '1 Vial',
                'composition' => $item->description,
                'description' => $item->description,
                'image' => $item->cover_image_url,
                'category' => $item->category->name ?? 'Uncategorized',
                'normal_price' => $item->normal_price,
                'currency' => $item->currency
            ]
        ]);
    }

    public function getProductsByCategory($categoryId)
    {
        $items = Item::where('category_id', $categoryId)
            ->where('is_active', true)
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'trade_name' => $item->name_en,
                    'form' => 'Vial',
                    'packaging' => '1 Vial',
                    'composition' => $item->description,
                    'image' => $item->cover_image_url,
                    'normal_price' => $item->normal_price,
                    'currency' => $item->currency
                ];
            });

        return response()->json([
            'success' => true,
            'products' => $items
        ]);
    }



    public function getQualityContent()
    {
        $qualitySettings = Setting::where('group', 'quality')
            ->orWhere('key', 'like', 'quality%')
            ->orWhere('key', 'like', 'strategy%')
            ->orWhere('key', 'like', 'manufacturing%')
            ->pluck('value', 'key')
            ->toArray();

        return response()->json([
            'success' => true,
            'quality' => [
                'title_en' => $qualitySettings['quality_title_en'] ?? 'Quality Assurance',
                'title_es' => $qualitySettings['quality_title_es'] ?? 'Garantía de Calidad',
                'strategy' => [
                    'image' => $this->getImageUrl($qualitySettings['strategy_image'] ?? 'uploads/1111.jpg'),
                    'title_en' => $qualitySettings['strategy_title_en'] ?? 'Strategy',
                    'title_es' => $qualitySettings['strategy_title_es'] ?? 'Estrategia',
                    'description_en' => $qualitySettings['strategy_description_en'] ?? 'Product – choose the right product within the health group, offering the highest quality at fair and affordable prices',
                    'description_es' => $qualitySettings['strategy_description_es'] ?? 'Producto – elegir el producto adecuado dentro del grupo de salud, ofreciendo la más alta calidad a precios justos y asequibles',
                    'link' => $qualitySettings['strategy_link'] ?? 'quality.html'
                ],
                'quality_card' => [
                    'image' => $this->getImageUrl($qualitySettings['quality_card_image'] ?? 'uploads/blog-02.jpg'),
                    'title_en' => $qualitySettings['quality_card_title_en'] ?? 'Quality',
                    'title_es' => $qualitySettings['quality_card_title_es'] ?? 'Calidad',
                    'description_en' => $qualitySettings['quality_card_description_en'] ?? 'Plante Pharma products have an effective formulation and innovative combination of ingredients.',
                    'description_es' => $qualitySettings['quality_card_description_es'] ?? 'Los productos de Plante Pharma tienen una formulación efectiva y una combinación innovadora de ingredientes.',
                    'link' => $qualitySettings['quality_card_link'] ?? 'quality.html'
                ],
                'manufacturing' => [
                    'image' => $this->getImageUrl($qualitySettings['manufacturing_image'] ?? 'uploads/blog-03.jpg'),
                    'title_en' => $qualitySettings['manufacturing_title_en'] ?? 'Manufacturing',
                    'title_es' => $qualitySettings['manufacturing_title_es'] ?? 'Fabricación',
                    'description_en' => $qualitySettings['manufacturing_description_en'] ?? 'All our products are manufactured in the EU under GMP standards using top quality manufacturing equipment and strict quality control.',
                    'description_es' => $qualitySettings['manufacturing_description_es'] ?? 'Todos nuestros productos son fabricados en la UE bajo estándares GMP utilizando equipos de fabricación de primera calidad y control de calidad estricto.',
                    'link' => $qualitySettings['manufacturing_link'] ?? 'quality.html'
                ]
            ]
        ]);
    }

    public function getAboutContent()
    {
        $aboutSettings = Setting::where('group', 'about')
            ->orWhere('key', 'like', 'about%')
            ->orWhere('key', 'like', 'mission%')
            ->orWhere('key', 'like', 'why_choose%')
            ->orWhere('key', 'like', 'values%')
            ->pluck('value', 'key')
            ->toArray();

        return response()->json([
            'success' => true,
            'about' => [
                'title_en' => $aboutSettings['about_title_en'] ?? 'About Plante Pharma',
                'title_es' => $aboutSettings['about_title_es'] ?? 'Sobre Plante Pharma',
                'description_en' => $aboutSettings['about_description_en'] ?? 'Plante Pharma is a producer of Medicine and dietary supplements, intended for sale only in pharmacies. From the beginning of our activity in the pharmaceutical market, we focus on innovation and the effectiveness of recipes and products.',
                'description_es' => $aboutSettings['about_description_es'] ?? 'Plante Pharma es un productor de medicamentos y suplementos dietéticos, destinados a la venta exclusiva en farmacias. Desde el inicio de nuestra actividad en el mercado farmacéutico, nos enfocamos en la innovación y la efectividad de las recetas y productos.',
                'image' => $this->getImageUrl($aboutSettings['about_image'] ?? 'images/logo.png'),
                'mission' => [
                    'title_en' => $aboutSettings['mission_title_en'] ?? 'Our Mission & Vision',
                    'title_es' => $aboutSettings['mission_title_es'] ?? 'Nuestra Misión y Visión',
                    'description_en' => $aboutSettings['mission_description_en'] ?? 'Always offer a premium and effective product in the health segment at prices affordable to everyone, including proper advice guaranteeing optimal results.',
                    'description_es' => $aboutSettings['mission_description_es'] ?? 'Ofrecer siempre un producto premium y efectivo en el segmento de la salud a precios asequibles para todos, incluyendo el asesoramiento adecuado que garantice resultados óptimos.'
                ],
                'why_choose' => [
                    'title_en' => $aboutSettings['why_choose_title_en'] ?? 'Why Choose us?',
                    'title_es' => $aboutSettings['why_choose_title_es'] ?? '¿Por qué elegirnos?',
                    'description_en' => $aboutSettings['why_choose_description_en'] ?? 'Plante Pharma products have an effective formulation and innovative combination of ingredients. The selection of raw materials is based on their purity and safety.',
                    'description_es' => $aboutSettings['why_choose_description_es'] ?? 'Los productos de Plante Pharma tienen una formulación efectiva y una combinación innovadora de ingredientes. La selección de materias primas se basa en su pureza y seguridad.'
                ],
                'values' => [
                    'title_en' => $aboutSettings['values_title_en'] ?? 'Our Values',
                    'title_es' => $aboutSettings['values_title_es'] ?? 'Nuestros Valores',
                    'description_en' => $aboutSettings['values_description_en'] ?? 'To treat every employee with dignity & respect and create a culture of continuous learning & growth.',
                    'description_es' => $aboutSettings['values_description_es'] ?? 'Tratar a cada empleado con dignidad y respeto y crear una cultura de aprendizaje y crecimiento continuo.'
                ]
            ]
        ]);
    }

    public function changeLanguage(Request $request)
    {
        $validated = $request->validate([
            'language' => 'required|in:en,es'
        ]);

        Session::put('language', $validated['language']);

        return response()->json([
            'success' => true,
            'message' => 'Language changed successfully'
        ]);
    }

    public function submitContact(Request $request)
    {
    // Log incoming payload to help debug contact submissions
    \Log::info('Contact form payload', $request->all());

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string|max:1000'
    ]);

        try {
        // Save to database (this should always work)
        $feedback = Feedback::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'type' => 'contact'
        ]);

        \Log::info('Contact saved', ['id' => $feedback->id ?? null]);



        // Try to send email, but don't fail if mail server is down
        try {
            // You can add email sending here later when mail server is configured
            // Mail::to('info@plantepharma.eu')->send(new ContactFormSubmitted($validated));
        } catch (\Exception $mailException) {
            // Log the mail error but don't show it to the user
            \Log::error('Mail sending failed: ' . $mailException->getMessage());
        }

        // If the request expects JSON (AJAX), return JSON. Otherwise redirect back with flash message.
        if ($request->wantsJson() || $request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We have received your inquiry and will get back to you soon.'
            ]);
        }

        return redirect()->back()->with('success', 'Thank you for your message! We have received your inquiry and will get back to you soon.');

    } catch (\Exception $e) {
        \Log::error('Contact form submission failed: ' . $e->getMessage());

        if ($request->wantsJson() || $request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an issue submitting your form. Please try again or email us directly at info@plantepharma.eu'
            ], 500);
        }

        return redirect()->back()->withInput()->withErrors(['message' => 'Sorry, there was an issue submitting your form. Please try again or email us directly at info@plantepharma.eu']);
    }
}

    /**
     * Get absolute URL for images
     */
    private function getImageUrl($path)
    {
        if (empty($path)) {
            return asset('images/default-image.png');
        }

        // If already an absolute URL
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // If it's a relative path starting with '/'
        if (strpos($path, '/') === 0) {
            return asset($path);
        }

        // Check if file exists in public directory
        if (file_exists(public_path($path))) {
            return asset($path);
        }

        // Check if file exists in storage
        if (\Storage::disk('public')->exists($path)) {
            return asset('storage/' . $path);
        }

        // Return default image if not found
        return asset('images/default-image.png');
    }


}
