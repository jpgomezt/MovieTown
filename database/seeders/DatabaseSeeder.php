<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

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
    }
}
