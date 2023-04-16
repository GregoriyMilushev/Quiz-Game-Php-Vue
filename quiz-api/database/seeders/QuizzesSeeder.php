<?php
require_once __DIR__ . '/../database.php';

$quotes = [
    'Spread love everywhere you go. Let no one ever come to you without leaving happier.' => 'Mother Teresa',
    'In the end, its not the years in your life that count. Its the life in your years.' => 'Abraham Lincoln',
    'That which does not kill us makes us stronger.' => 'Friedrich Nietzsche',
    'Life is either a daring adventure or nothing at all.' => 'John Lennon',

    'You miss 100% of the shots you dont take.' => 'Wayne Gretzky',
    'Remember that not getting what you want is sometimes a wonderful stroke of luck.' => 'Dalai Lama',
    'Our lives begin to end the day we become silent about things that matter.' => 'Martin Luther King Jr.',
    'The only way to do great work is to love what you do.' => 'Steve Jobs',
    'The journey of a thousand miles begins with one step.' => 'Lao Tzu',
    'Dont count the days, make the days count.' => 'Muhammad Ali',
    'The way to get started is to quit talking and begin doing.' => 'Walt Disney',

    'My momma always said, Life was like a box of chocolates. You never know what you are gonna get.' => 'Forrest Gump',
    'Well, there were three of us in this marriage, so it was a bit crowded' => 'Princess Diana',
    'May you live all the days of your life.' => 'Jonathan Swift',
    'The way I see it, if you want the rainbow, you gotta put up with the rain.' => 'Dolly Parton',
    'Love the life you live. Live the life you love.' => 'Bob Marley',
    'The greatest glory in living lies not in never falling, but in rising every time we fall.' => 'Nelson Mandela',
    'The future belongs to those who believe in the beauty of their dreams.' => 'Eleanor Roosevelt',

    'The purpose of a writer is to keep civilization from destroying itself' => 'Albert Camus',
    'Whether you think you can or you think you cant, you are right.' => 'Henry Ford',
    'Twenty years from now you will be more disappointed by the things you did not do than by the ones you did do.' => 'Mark Twain',
    'Success is not final; failure is not fatal: It is the courage to continue that counts.' => 'Winston Churchill',
    
    "The best way to predict the future is to create it." => "Abraham Lincoln",
    "Whatever the mind of man can conceive and believe, it can achieve." => "Napoleon Hill",
    "I have not failed. I've just found 10,000 ways that won't work." => "Thomas Edison",
    "If you want to live a happy life, tie it to a goal, not to people or things." => "Albert Einstein",
    "Believe you can and you're halfway there." => "Theodore Roosevelt",
    "The mind is everything. What you think you become." => "Buddha",
    "I can't change the direction of the wind, but I can adjust my sails to always reach my destination." => "Jimmy Dean",
    "Don't watch the clock; do what it does. Keep going." => "Sam Levenson",
    "Strive not to be a success, but rather to be of value." => "Albert Einstein",
    "It does not matter how slowly you go as long as you do not stop." => "Confucius"
];

try {
    //prepared statements
    $authorStatement = $pdo->prepare("INSERT INTO authors (author) VALUES (?)");
    $quoteStatement = $pdo->prepare("INSERT INTO quotes (quote, author_id) VALUES (?, ?)");
    $selectAuthorStatement = $pdo->prepare("SELECT id FROM authors WHERE author = ?");

    foreach ($quotes as $quote => $author) {
        // Check if author already exists in the authors table
        $selectAuthorStatement->execute([$author]);
        $result = $selectAuthorStatement->fetch(PDO::FETCH_ASSOC);
 
        if ($result) {
            // Author already exists, use the existing ID
            $author_id = $result['id'];
        } else {
            $authorStatement->execute([$author]);
            $author_id = $pdo->lastInsertId();
        }
        $quoteStatement->execute([$quote, $author_id]);
    }

    echo "Data inserted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}