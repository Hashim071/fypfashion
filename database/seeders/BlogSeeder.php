<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $this->command->info('No users found. Please create a user first to assign as author.');
            return;
        }

        // ✅ Data ko title, image, excerpt, aur body ke sath combine kar dein
        $blogData = [
            [
                'title' => "The Art of Bespoke Tailoring: A Deep Dive into Custom Suits",
                'image' => 'admin/assets/images/logo/custom-suit.jpg',
                'excerpt' => 'Discover the unparalleled world of bespoke tailoring. From the first measurement to the final stitch, learn what makes a custom suit a true masterpiece of personal style and craftsmanship.',
                'body' => '<p>Bespoke tailoring is more than just clothing; it is an experience. It begins with a detailed consultation where your personal style, preferences, and needs are discussed. Every measurement is taken with precision to ensure a flawless fit that complements your physique perfectly.</p><p>The process involves selecting from the world\'s finest fabrics, followed by multiple fittings. Each fitting allows the tailor to refine the garment, sculpting it to your body. This meticulous attention to detail results in a suit that is not only unique but also exceptionally comfortable and durable.</p>'
            ],
            [
                'title' => "Fall 2025 Couture Trends: What's Hot Off the Runway",
                'image' => 'admin/assets/images/logo/runway-fashion.jpg',
                'excerpt' => 'Get ahead of the curve with a sneak peek at the Fall 2025 couture trends. We are breaking down the key silhouettes, bold color palettes, and luxurious fabrics seen on the international runways.',
                'body' => '<p>This fall, couture is all about making a statement. Expect to see dramatic silhouettes with structured shoulders and voluminous skirts. Rich jewel tones like emerald, sapphire, and ruby are dominating the color palettes, often paired with opulent fabrics like velvet and brocade.</p><p>Hand-stitched embellishments and intricate embroidery continue to be a hallmark of couture, adding a layer of artistry to every piece. The focus is on creating timeless garments that are both modern and classic, reflecting a new era of sophisticated elegance.</p>'
            ],
            [
                'title' => "Choosing the Perfect Fabric for Your Custom Evening Gown",
                'image' => 'admin/assets/images/logo/evening-gown-fabric.jpg',
                'excerpt' => 'The fabric is the soul of a dress. This guide will help you navigate the luxurious world of textiles, from flowing silks to intricate laces, to choose the perfect material for your dream evening gown.',
                'body' => '<p>Selecting the right fabric is a critical step in creating a custom gown. For a soft and romantic look, consider silk chiffon or organza, which drape beautifully and move with grace. If you desire something more structured and opulent, silk mikado or duchess satin provide excellent body and a lustrous sheen.</p><p>Lace, with its delicate patterns, adds a touch of timeless romance. From French Chantilly to intricate Alençon, each type of lace offers a unique character. Your couturier will guide you through these choices to find a fabric that not only looks stunning but also feels incredible to wear.</p>'
            ],
            // ... (Isi tarha baqi 7 blog posts ki details)
            [
                'title' => "Accessorizing Your Couture Outfit: The Ultimate Guide for 2025",
                'image' => 'admin/assets/images/logo/couture-accessories.jpg',
                'excerpt' => 'The right accessories can elevate a couture outfit from beautiful to breathtaking. Learn how to select the perfect jewelry, shoes, and handbags to complement your custom-made garments.',
                'body' => '<p>Accessories are the finishing touch that completes your look. For a couture gown, less is often more. Opt for one statement piece, such as chandelier earrings or a bold necklace, rather than overwhelming the outfit. The metal should complement the tone of your dress—gold for warm colors, and silver or platinum for cooler shades.</p><p>When it comes to handbags, a classic clutch is always a sophisticated choice. Shoes should be elegant and comfortable enough for the occasion. The key is to create a harmonious balance where each element enhances the others without competing for attention.</p>'
            ],
             [
                'title' => "From Sketch to Reality: The Journey of a Couture Dress",
                'image' => 'admin/assets/images/logo/fashion-sketch.jpg',
                'excerpt' => 'Ever wondered how a couture dress comes to life? We take you behind the scenes on the magical journey from the initial design sketch to the final breathtaking creation worn on the red carpet.',
                'body' => '<p>The creation of a couture dress is a journey of artistry and precision. It all starts with an idea, a simple sketch on paper. This vision is then brought to life through a muslin pattern, known as a toile, which is fitted and perfected on a mannequin or the client.</p><p>Once the pattern is flawless, the real fabric is cut and meticulously hand-sewn by a team of skilled artisans. Embellishments like beads, sequins, or embroidery are often applied by hand, a process that can take hundreds of hours. The final result is not just a dress, but a wearable piece of art.</p>'
            ],
            [
                'title' => "Why Investing in a Custom-Made Wardrobe is a Smart Choice",
                'image' => 'admin/assets/images/logo/custom-wardrobe.jpg',
                'excerpt' => 'Fast fashion is fleeting, but true style is eternal. Discover the long-term benefits of investing in a custom-made wardrobe, from superior quality and perfect fit to sustainable and timeless pieces.',
                'body' => '<p>Investing in custom-made clothing is a move towards a more sustainable and personal wardrobe. Unlike mass-produced items, couture pieces are made to last, using high-quality materials and superior construction techniques. This means they remain beautiful for years, reducing the need for constant replacement.</p><p>Furthermore, each garment is made to your exact measurements, ensuring a perfect fit that enhances your confidence. A custom wardrobe is a reflection of your unique personality, curated with pieces that you truly love and will cherish for a lifetime.</p>'
            ],
             [
                'title' => "The Timeless Elegance of Hand-Stitched Embellishments",
                'image' => 'admin/assets/images/logo/hand-stitched.jpg',
                'excerpt' => 'In a world of mass production, the art of hand-stitching stands out. Explore the beauty and intricacy of hand-stitched embellishments and why they are a hallmark of true luxury couture.',
                'body' => '<p>Hand-stitched embellishments are what separate couture from ready-to-wear. This painstaking process involves applying beads, crystals, pearls, and sequins one by one, creating intricate patterns and textures that machines cannot replicate. It is a testament to the skill and patience of the artisan.</p><p>This level of detail adds depth and dimension to a garment, transforming it into a unique work of art. Whether it\'s a delicate scattering of crystals on a bodice or a fully beaded gown, hand-stitching is a symbol of ultimate luxury and exquisite craftsmanship.</p>'
            ],
            [
                'title' => "Finding Your Signature Style with a Personal Couturier",
                'image' => 'admin/assets/images/logo/personal-stylist.jpg',
                'excerpt' => 'A personal couturier does more than just make clothes; they help you discover and define your signature style. Learn how working with an expert can transform your wardrobe and your confidence.',
                'body' => '<p>Finding your signature style is a journey of self-discovery. A personal couturier acts as your guide, helping you understand what silhouettes, colors, and fabrics best suit your personality, lifestyle, and physique. They listen to your ideas and translate them into beautiful, wearable garments.</p><p>Through this collaborative process, you can build a cohesive wardrobe that truly represents who you are. Each piece is designed with you in mind, ensuring that you not only look your best but also feel completely comfortable and confident in every situation.</p>'
            ],
            [
                'title' => "Couture for Men: Redefining Modern Masculinity and Style",
                'image' => 'admin/assets/images/logo/men-couture.jpg',
                'excerpt' => 'Couture is not just for women. The world of bespoke menswear is rich with tradition and innovation. Explore how custom-made suits and formalwear are redefining style for the modern gentleman.',
                'body' => '<p>Men\'s couture offers a level of sophistication and personalization that is unmatched. A bespoke suit is the cornerstone of a gentleman\'s wardrobe, tailored to perfection to enhance his physique. The choice of fabric, lapel style, and even the stitching can be customized to reflect his personal taste.</p><p>Beyond suits, couture for men extends to custom-made shirts, coats, and formalwear. It is about creating a wardrobe that is not only stylish but also functional and impeccably crafted. It is an investment in quality and a statement of refined masculinity.</p>'
            ],
            [
                'title' => "A Look Inside the Atelier: The Magic of Couture Creation Revealed",
                'image' => 'admin/assets/images/logo/atelier-workshop.jpg',
                'excerpt' => 'Step into the magical world of a couture atelier. From the pattern makers to the seamstresses and embroiderers, meet the talented artisans who bring high-fashion dreams to life.',
                'body' => '<p>An atelier is the heart of any couture house. It is a bustling hub of creativity and skill, where master artisans work in harmony to create exquisite garments. The pattern maker, or \'premier d\'atelier\', translates the designer\'s sketch into a three-dimensional form.</p><p>Seamstresses, known as \'petites mains\', meticulously stitch each garment by hand, while specialized embroiderers add the final decorative touches. It is a world where age-old techniques are preserved and passed down, ensuring that every couture piece is a masterpiece of human artistry.</p>'
            ]
        ];

        foreach ($blogData as $data) {
            Blog::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'image' => $data['image'],
                'excerpt' => $data['excerpt'], // ✅ Yahan se custom excerpt ayega
                'body' => $data['body'],       // ✅ Yahan se custom body/details ayegi
                'user_id' => $user->id,
                'published_at' => now()->subDays(rand(1, 45)),
            ]);
        }
    }
}
