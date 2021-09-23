<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
use App\Models\Review;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Movie::create(
            [
                'title' => 'Harry Potter and the Sorcerers Stone',
                'plot' => 'An orphaned boy enrolls in a school of wizardry, where he learns the truth about himself, his family and the terrible evil that haunts the magical world.',
                'critics_score' => '3.8',
                'price' => '18000',
                'rent_quantity' => '8',
                'sell_quantity' => '10',
            ]
        );

        Movie::create(
            [
                'title' => 'Harry Potter and the Chamber of Secrets',
                'plot' => 'An ancient prophecy seems to be coming true when a mysterious presence begins stalking the corridors of a school of magic and leaving its victims paralyzed.',
                'critics_score' => '3.7',
                'price' => '9900',
                'rent_quantity' => '6',
                'sell_quantity' => '15',
            ]
        );

        Movie::create(
            [
                'title' => 'Harry Potter and the Prisoner of Azkaban',
                'plot' => 'Harry Potter, Ron and Hermione return to Hogwarts School of Witchcraft and Wizardry for their third year of study, where they delve into the mystery surrounding an escaped prisoner who poses a dangerous threat to the young wizard.',
                'critics_score' => '3.9',
                'price' => '16000',
                'rent_quantity' => '9',
                'sell_quantity' => '18',
            ]
        );

        Movie::create(
            [
                'title' => 'The Avengers',
                'plot' => 'Earth\'s mightiest heroes must come together and learn to fight as a team if they are going to stop the mischievous Loki and his alien army from enslaving humanity.',
                'critics_score' => '4',
                'price' => '20000',
                'rent_quantity' => '3',
                'sell_quantity' => '19',
            ]
        );

        Movie::create(
            [
                'title' => 'Avengers: Age of Ultron',
                'plot' => 'When Tony Stark and Bruce Banner try to jump-start a dormant peacekeeping program called Ultron, things go horribly wrong and it\'s up to Earth\'s mightiest heroes to stop the villainous Ultron from enacting his terrible plan.',
                'critics_score' => '3.6',
                'price' => '13000',
                'rent_quantity' => '8',
                'sell_quantity' => '16',
            ]
        );

        User::create(
            [
                'name' => 'Sebastian Urrego',
                'username' => 'urregozw',
                'address' => 'Calle 43 sur #33 - 50',
                'email' => 'urregozw@gmail.com',
                'password' => Hash::make('12345'),
            ]
        );

        User::create(
            [
                'name' => 'Juan Pablo Gomez',
                'username' => 'jpgomez',
                'address' => 'Calle 92 sur #70 - 100',
                'email' => 'jpgomez@gmail.com',
                'password' => Hash::make('12345'),
                'is_staff' => '1',
            ]
        );

        User::create(
            [
                'name' => 'Santiago Alzate',
                'username' => 'salzatec1',
                'address' => 'Avenida 57 #33 - 50',
                'email' => 'salzatec1@gmail.com',
                'password' => Hash::make('12345'),
                'has_rented_movies' => '1',
            ]
        );

        Review::create(
            [
                'opinion' => 'It was a good movie, but i did not understand the end credits',
                'stars' => 4,
                'is_visible' => true,
                'date' => '2021-09-22',
                'user_id' => 1,
                'movie_id' => 1,
            ]
        );


        Review::create(
            [
                'opinion' => 'I didn´t like the movie it was very scary and I dislike the protagonist',
                'stars' => 2,
                'is_visible' => false,
                'date' => '2021-09-22',
                'user_id' => 2,
                'movie_id' => 2,
            ]
        );


        Review::create(
            [
                'opinion' => 'The movie was marvelous! I will say it´s the best in the world',
                'stars' => 5,
                'is_visible' => true,
                'date' => '2021-09-22',
                'user_id' => 3,
                'movie_id' => 3,
            ]
        );

        Order::create(
            [
                'address' => 'Calle 1 #2 - 53210',
                'date' => '2021-09-22',
                'payment_type' => '2345678876543',
                'shipping_date' => '2021-09-22',
                'shipping_cost' => 2456,
                'total' => 10000,
                'is_shipped' => true,
                'user_id' => 1,
            ]
        );

        Order::create(
            [
                'address' => 'Calle 21 sur #123 - 3',
                'date' => '2021-09-22',
                'payment_type' => '2345678876543',
                'shipping_date' => '2021-09-22',
                'shipping_cost' => 2456,
                'total' => 10000,
                'is_shipped' => true,
                'user_id' => 2,
            ]
        );

        Order::create(
            [
                'address' => 'Avenida 2 #33 - 2',
                'date' => '2021-09-22',
                'payment_type' => '23443426543',
                'shipping_date' => '2021-09-24',
                'shipping_cost' => 126,
                'total' => 43320,
                'is_shipped' => false,
                'user_id' => 3,
            ]
        );
    }
}
