<?php

namespace Database\Seeders;

use App\Models\Etudiant;
use App\Models\Formation;
use App\Models\Section;
use App\Models\Groupe;
use Illuminate\Database\Seeder;

class EtudiantSeeder extends Seeder
{
    public function run(): void
    {
        $formations = Formation::all();

        // Some sample names
        $noms = ['Benali', 'Boudjemaa', 'Khelifi', 'Amrani', 'Touati', 'Messaoudi', 'Cherif', 'Saidi'];
        $prenoms = ['Mohamed', 'Ahmed', 'Yacine', 'Islam', 'Rania', 'Sara', 'Lina', 'Amine', 'Yasmine'];

        for ($i = 1; $i <= 550; $i++) {
            $formation = $formations->random();

            // Get sections for this formation
            $sections = Section::where('id_formation', $formation->id_formation)->get();

            $section = null;
            $groupe = null;

            if ($sections->isNotEmpty()) {
                $section = $sections->random();
                $groupes = Groupe::where('id_section', $section->id_section)->get();

                if ($groupes->isNotEmpty()) {
                    $groupe = $groupes->random();
                }
            }

            $nom = $noms[array_rand($noms)];
            $prenom = $prenoms[array_rand($prenoms)];

            Etudiant::create([
                'nom' => $nom,
                'prenom' => $prenom,
                'date_naissance' => date('Y-m-d', strtotime('-' . rand(18, 25) . ' years')),
                'email' => strtolower($prenom) . '.' . strtolower($nom) . $i . '@etu.univ.dz',
                'promo' => rand(2020, 2024),
                'id_formation' => $formation->id_formation,
                'section_id' => $section?->id_section,
                'group_id' => $groupe?->id_groupe,
            ]);
        }
    }
}
