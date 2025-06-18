<?php

namespace App\DataFixtures;

use App\Entity\Books;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $books = [
            [
                'name' => '1984',
                'genre' => 'Dystopian',
                'price' => 14.99,
                'author' => 'George Orwell',
                'image' => '1984.png',
                'description' => "A haunting tale set in a totalitarian regime where surveillance is omnipresent, and truth is manipulated. Orwell’s dystopian vision warns of a world dominated by oppressive authority. The novel follows Winston Smith, a man grappling with a reality controlled by the Party and Big Brother. His rebellion begins subtly but grows into a fight for freedom and individuality. Through bleak landscapes and thought-provoking themes, \"1984\" forces readers to question authority, truth, and the consequences of absolute power. A timeless classic that remains disturbingly relevant today, shedding light on the fragility of human liberty in the face of tyranny.",
            ],
            [
                'name' => 'Atomic Habits',
                'genre' => 'Self-help',
                'price' => 19.99,
                'author' => 'James Clear',
                'image' => 'atomic_habits.png',
                'description' => "James Clear provides practical strategies for forming good habits, breaking bad ones, and mastering the tiny behaviors that lead to remarkable results. \"Atomic Habits\" emphasizes the importance of making small changes that compound over time. Clear explains how identity and systems are critical to habit change and offers a framework that helps people improve daily. The book is backed by psychological research and real-life examples, making the advice actionable and relevant. Whether you're looking to boost productivity, build discipline, or simply make life improvements, this book offers an insightful and empowering roadmap for lasting change.",
            ],
            [
                'name' => 'Brave New World',
                'genre' => 'Science Fiction',
                'price' => 13.49,
                'author' => 'Aldous Huxley',
                'image' => 'brave_new_world.png',
                'description' => "In a future society driven by technological advancements and social engineering, individuals are conditioned for specific roles and pleasures. Aldous Huxley’s \"Brave New World\" explores the dangers of losing individuality in pursuit of comfort and control. The novel introduces us to a seemingly perfect world devoid of pain, where everyone is happy—but at the cost of freedom, love, and true identity. The story follows Bernard Marx and John the Savage as they confront the horrifying truth behind utopia. It’s a prophetic warning against consumerism, conformity, and the erosion of human values in the face of progress.",
            ],
            [
                'name' => 'The Catcher in the Rye',
                'genre' => 'Literary Fiction',
                'price' => 12.99,
                'author' => 'J.D. Salinger',
                'image' => 'catcher_in_the_rye.png',
                'description' => "Holden Caulfield, a cynical teenager, recounts his journey through New York City after being expelled from prep school. In \"The Catcher in the Rye\", Salinger captures the angst, alienation, and confusion of adolescence with raw honesty. Holden’s voice—both rebellious and vulnerable—reflects the inner turmoil of a young man grappling with the phoniness of the adult world. The novel is a poignant exploration of identity, mental health, and the desire to protect innocence. Its candid narrative style and emotional depth have made it a classic for generations of readers who see themselves in Holden’s struggle to find meaning.",
            ],
            [
                'name' => 'Mini Philosophy',
                'genre' => 'Philosophy',
                'price' => 10.99,
                'author' => 'Jonny Thomson',
                'image' => 'mini_philosophy.png',
                'description' => "A concise and accessible guide to big philosophical ideas, \"Mini Philosophy\" explores essential questions about existence, ethics, and knowledge. Jonny Thomson breaks down complex theories from famous philosophers into digestible, engaging insights that appeal to both newcomers and seasoned thinkers. From Plato’s allegory of the cave to Kant’s categorical imperative, the book serves as a crash course in understanding how philosophy shapes our lives and decisions. Witty and thought-provoking, it invites readers to examine their own beliefs and assumptions. It’s the perfect introduction for curious minds seeking to explore the wisdom of centuries in just a few pages.",
            ],
            [
                'name' => 'Sapiens',
                'genre' => 'History',
                'price' => 21.99,
                'author' => 'Yuval Noah Harari',
                'image' => 'sapiens.png',
                'description' => "Harari takes readers on a sweeping journey through the history of humankind, from the emergence of Homo sapiens to the modern age. \"Sapiens\" challenges conventional narratives and explores how biology, culture, and economics have shaped our societies. With wit and depth, Harari delves into agriculture, religion, empires, and capitalism, weaving a compelling narrative of human evolution. He asks provocative questions about happiness, inequality, and the future of our species. Accessible and thought-stirring, \"Sapiens\" is a must-read for anyone interested in understanding the past and how it continues to influence our present and possible futures.",
            ],
            [
                'name' => 'The Alchemist',
                'genre' => 'Adventure',
                'price' => 15.00,
                'author' => 'Paulo Coelho',
                'image' => 'the_alchemist.png',
                'description' => "Santiago, a young shepherd, embarks on a journey to discover his personal legend and fulfill his dreams. Paulo Coelho’s \"The Alchemist\" is a lyrical tale of self-discovery, fate, and perseverance. Guided by omens, mentors, and inner wisdom, Santiago’s quest across deserts and through ancient cities becomes a metaphor for the journey of life. The novel blends mysticism, philosophy, and adventure to reveal truths about following one’s heart. It has inspired millions around the world with its message of hope and transformation. A simple yet profound reminder that the treasure we seek often lies within.",
            ],
            [
                'name' => 'The Book of Five Rings',
                'genre' => 'Martial Arts / Philosophy',
                'price' => 11.50,
                'author' => 'Miyamoto Musashi',
                'image' => 'the_book_of_five_rings.png',
                'description' => "A classic treatise on strategy, combat, and personal mastery, \"The Book of Five Rings\" offers timeless wisdom from one of Japan’s greatest swordsmen. Miyamoto Musashi shares insights not only about physical battle but also about mindset, discipline, and life philosophy. Divided into five sections—Earth, Water, Fire, Wind, and Void—the book discusses techniques and tactics applicable to martial arts and beyond. Its teachings have been embraced by business leaders, athletes, and seekers of personal growth. Written in the 17th century, its relevance continues today as a guide to resilience, focus, and purposeful living in any field of endeavor.",
            ],
            [
                'name' => 'The Book Thief',
                'genre' => 'Historical Fiction',
                'price' => 14.50,
                'author' => 'Markus Zusak',
                'image' => 'the_book_thief.png',
                'description' => "Narrated by Death, \"The Book Thief\" tells the story of Liesel, a young girl in Nazi Germany who finds solace in books during a time of terror and loss. As she learns to read and begins stealing books, Liesel discovers the power of words to comfort, resist, and connect. Zusak’s poetic writing style and unique perspective bring humanity and hope to a tragic era. The novel portrays love, courage, and resilience in the face of unimaginable hardship. It is a haunting and beautiful tribute to the enduring strength of the human spirit, even in the darkest of times.",
            ],
            [
                'name' => 'The Great Gatsby',
                'genre' => 'Classic',
                'price' => 9.99,
                'author' => 'F. Scott Fitzgerald',
                'image' => 'the_great_gatsby.png',
                'description' => "Set in the Roaring Twenties, \"The Great Gatsby\" chronicles the mysterious millionaire Jay Gatsby and his obsessive love for Daisy Buchanan. Narrated by Nick Carraway, the novel explores themes of wealth, illusion, and the American Dream. Fitzgerald’s lyrical prose paints a vivid portrait of opulence, disillusionment, and moral decay in post-war America. As Gatsby’s dream unravels, the story reveals the emptiness behind the glittering façade of high society. Timeless and evocative, it remains one of the most powerful critiques of ambition and desire, capturing the spirit and tragedy of an era—and of the human heart.",
            ],
            [
                'name' => 'The Hobbit',
                'genre' => 'Fantasy',
                'price' => 13.75,
                'author' => 'J.R.R. Tolkien',
                'image' => 'the_hobbit.png',
                'description' => "Bilbo Baggins, a comfort-loving hobbit, is swept into an epic quest to reclaim a lost dwarf kingdom from a fearsome dragon. In \"The Hobbit\", Tolkien masterfully weaves a tale of adventure, courage, and growth. Alongside dwarves and wizards, Bilbo encounters trolls, goblins, and more, discovering strength he never knew he had. The novel combines rich world-building with timeless themes of bravery and transformation. A prelude to the Lord of the Rings, it stands strong on its own as a beloved classic that continues to enchant readers of all ages with its whimsical tone and unforgettable characters.",
            ],
            [
                'name' => 'The Odyssey',
                'genre' => 'Epic Poetry',
                'price' => 16.20,
                'author' => 'Homer',
                'image' => 'the_odyssey.png',
                'description' => "One of the oldest and most influential works of Western literature, \"The Odyssey\" tells the story of Odysseus and his perilous journey home from the Trojan War. Facing gods, monsters, and temptation, he battles for survival and reunion with his family. The epic explores themes of heroism, loyalty, and fate. Homer’s poetic narrative has captivated audiences for millennia, offering deep insight into human resilience and the will to overcome. Each challenge Odysseus faces reveals more about character and consequence, making this an enduring tale of adventure and the enduring strength of human spirit against all odds.",
            ],
            [
                'name' => 'The Power of Now',
                'genre' => 'Spirituality',
                'price' => 17.80,
                'author' => 'Eckhart Tolle',
                'image' => 'the_power_of_now.png',
                'description' => "Eckhart Tolle invites readers to step out of the chaos of the mind and into the present moment. \"The Power of Now\" is a spiritual guide that emphasizes awareness and mindfulness as the path to inner peace. Through clear explanations and practical guidance, Tolle reveals how identification with the ego creates suffering. Letting go of past regrets and future anxieties allows for transformative healing. The book has helped millions cultivate a deeper connection to themselves and the world. It’s not just a read—it’s an experience that can reshape how one lives, thinks, and feels.",
            ],
            [
                'name' => 'Thinking, Fast and Slow',
                'genre' => 'Psychology',
                'price' => 18.99,
                'author' => 'Daniel Kahneman',
                'image' => 'thinking_fast_and_slow.png',
                'description' => "Daniel Kahneman, Nobel Prize-winning psychologist, explores the two systems that drive the way we think. System 1 is fast, intuitive, and emotional; System 2 is slower, more deliberate, and logical. \"Thinking, Fast and Slow\" delves into cognitive biases, decision-making, and human error in judgment. With compelling examples, Kahneman illustrates how and why we often get things wrong. This groundbreaking book reshapes our understanding of reason and irrationality, influencing fields from economics to medicine. It’s essential reading for anyone who wants to better understand their own mind and the hidden influences behind everyday choices.",
            ],
            [
                'name' => 'Wabi Sabi',
                'genre' => 'Philosophy / Aesthetics',
                'price' => 12.50,
                'author' => 'Beth Kempton',
                'image' => 'wabi_sabi.png',
                'description' => "\"Wabi Sabi\" explores the Japanese philosophy of embracing imperfection, transience, and simplicity. Beth Kempton guides readers to find beauty in the imperfect and the incomplete, helping them slow down and reconnect with what truly matters. Blending ancient wisdom with modern insight, the book offers practical advice for living mindfully in a busy world. From home décor to emotional well-being, Wabi Sabi can be applied to every aspect of life. It’s a poetic and transformative approach to living, urging us to appreciate the cracks, the pauses, and the quiet moments that make life deeply meaningful.",
            ],
        ];

        foreach ($books as $data) {
            $book = new Books();
            $book->setName($data['name']);
            $book->setGenre($data['genre']);
            $book->setPrice($data['price']);
            $book->setAuthor($data['author']);
            $book->setImage($data['image']);
            $book->setDescription($data['description']);
            $manager->persist($book);
        }

        $manager->flush();
    }
}