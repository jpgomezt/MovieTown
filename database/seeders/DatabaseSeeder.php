<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        Movie::create(
            [
                "title" => "Harry Potter and the Sorcerers Stone",
                "plot" => "An orphaned boy enrolls in a school of wizardry, where he learns the truth about himself, his family and the terrible evil that haunts the magical world.",
                "critics_score" => "2.8",
                "price" => "13.28",
                "rent_quantity" => "8",
                "sell_quantity" => "10",
            ]
        );

        Movie::create(
            [
                "title" => "Harry Potter and the Chamber of Secrets",
                "plot" => "An ancient prophecy seems to be coming true when a mysterious presence begins stalking the corridors of a school of magic and leaving its victims paralyzed.",
                "critics_score" => "3.7",
                "price" => "15.70",
                "rent_quantity" => "6",
                "sell_quantity" => "15",
            ]
        );

        Movie::create(
            [
                "title" => "The Avengers",
                "plot" => "Earth's mightiest heroes must come together and learn to fight as a team if they are going to stop the mischievous Loki and his alien army from enslaving humanity.",
                "critics_score" => "4.7",
                "price" => "11.71",
                "rent_quantity" => "3",
                "sell_quantity" => "19",
            ]
        );

        Movie::create(
            [
                "title" => "Harry Potter and the Prisoner of Azkaban",
                "plot" => "Harry Potter, Ron and Hermione return to Hogwarts School of Witchcraft and Wizardry for their third year of study, where they delve into the mystery surrounding an escaped prisoner who poses a dangerous threat to the young wizard.",
                "critics_score" => "4.9",
                "price" => "15.98",
                "rent_quantity" => "9",
                "sell_quantity" => "18",
            ]
        );

        Movie::create(
            [
                "title" => "Harry Potter and the Goblet of Fire",
                "plot" => "Harry Potter finds himself competing in a hazardous tournament between rival schools of magic, but he is distracted by recurring nightmares.",
                "critics_score" => "5",
                "price" => "10.59",
                "rent_quantity" => "0",
                "sell_quantity" => "5",
            ]
        );

        Movie::create(
            [
                "title" => "Avengers: Age of Ultron",
                "plot" => "When Tony Stark and Bruce Banner try to jump-start a dormant peacekeeping program called Ultron, things go horribly wrong and it\"s up to Earth\"s mightiest heroes to stop the villainous Ultron from enacting his terrible plan.",
                "critics_score" => "1.6",
                "price" => "12.99",
                "rent_quantity" => "8",
                "sell_quantity" => "16",
            ]
        );

        Movie::create(
            [
                "title" => "Harry Potter and the Order of the Phoenix",
                "plot" => "With their warning about Lord Voldemort's return scoffed at, Harry and Dumbledore are targeted by the Wizard authorities as an authoritarian bureaucrat slowly seizes power at Hogwarts.",
                "critics_score" => "1.7",
                "price" => "8.99",
                "rent_quantity" => "7",
                "sell_quantity" => "25",
            ]
        );

        Movie::create(
            [
                "title" => "Harry Potter and the Half-Blood Prince",
                "plot" => "As Harry Potter begins his sixth year at Hogwarts, he discovers an old book marked as \"the property of the Half-Blood Prince\" and begins to learn more about Lord Voldemort's dark past.",
                "critics_score" => "2.3",
                "price" => "18.98",
                "rent_quantity" => "10",
                "sell_quantity" => "3",
            ]
        );

        Movie::create(
            [
                "title" => "Avengers: Infinity War",
                "plot" => "The Avengers and their allies must be willing to sacrifice all in an attempt to defeat the powerful Thanos before his blitz of devastation and ruin puts an end to the universe.",
                "critics_score" => "2.8",
                "price" => "12.99",
                "rent_quantity" => "0",
                "sell_quantity" => "5",
            ]
        );

        Movie::create(
            [
                "title" => "Harry Potter and the Deathly Hallows: Part 1",
                "plot" => "As Harry, Ron, and Hermione race against time and evil to destroy the Horcruxes, they uncover the existence of the three most powerful objects in the wizarding world: the Deathly Hallows.",
                "critics_score" => "3.2",
                "price" => "14.99",
                "rent_quantity" => "0",
                "sell_quantity" => "5",
            ]
        );

        Movie::create(
            [
                "title" => "Harry Potter and the Deathly Hallows: Part 2",
                "plot" => "Harry, Ron, and Hermione search for Voldemort's remaining Horcruxes in their effort to destroy the Dark Lord as the final battle rages on at Hogwarts.",
                "critics_score" => "4",
                "price" => "14.88",
                "rent_quantity" => "2",
                "sell_quantity" => "7",
            ]
        );

        Movie::create(
            [
                "title" => "Avengers: Endgame",
                "plot" => "After the devastating events of Avengers: Infinity War (2018), the universe is in ruins. With the help of remaining allies, the Avengers assemble once more in order to reverse Thanos' actions and restore balance to the universe.",
                "critics_score" => "4.2",
                "price" => "14.99",
                "rent_quantity" => "10",
                "sell_quantity" => "20",
            ]
        );

        User::create(
            [
                "name" => "Sebastian Urrego",
                "username" => "urregozw",
                "address" => "Calle 43 sur #33 - 50",
                "email" => "urregozw@gmail.com",
                "password" => Hash::make("12345"),
            ]
        );

        User::create(
            [
                "name" => "Juan Pablo Gomez",
                "username" => "jpgomez",
                "address" => "Calle 92 sur #70 - 100",
                "email" => "jpgomez@gmail.com",
                "password" => Hash::make("12345"),
            ]
        );

        User::create(
            [
                "name" => "Santiago Alzate",
                "username" => "salzatec1",
                "address" => "Avenida 57 #33 - 50",
                "email" => "salzatec1@gmail.com",
                "password" => Hash::make("12345"),
                "has_rented_movies" => "1",
            ]
        );

        User::create(
            [
                "name" => "Admin",
                "username" => "admin",
                "address" => "Cra 29 AA # 36 Sur - 151",
                "email" => "admin@movietown.com",
                "password" => Hash::make("admin12345"),
                "is_staff" => "1",
            ]
        );

        Review::create(
            [
                "opinion" => "It was a good movie, but i did not understand the end credits",
                "stars" => 4,
                "is_visible" => true,
                "date" => "2021-09-22",
                "user_id" => 1,
                "movie_id" => 1,
            ]
        );


        Review::create(
            [
                "opinion" => "I didn't like the movie it was very scary and I dislike the protagonist",
                "stars" => 2,
                "is_visible" => false,
                "date" => "2021-09-22",
                "user_id" => 2,
                "movie_id" => 2,
            ]
        );


        Review::create(
            [
                "opinion" => "The movie was marvelous! I will say it's the best in the world",
                "stars" => 5,
                "is_visible" => true,
                "date" => "2021-09-22",
                "user_id" => 3,
                "movie_id" => 3,
            ]
        );
    }
}
