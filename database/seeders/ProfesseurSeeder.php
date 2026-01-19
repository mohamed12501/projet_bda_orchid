<?php

namespace Database\Seeders;

use App\Models\Professeur;
use App\Models\Departement;
use Illuminate\Database\Seeder;

class ProfesseurSeeder extends Seeder
{
    public function run(): void
    {
        $departements = Departement::all();

        // Different realistic names for professors
        $noms = [
            'Benkaci', 'Bouaziz', 'Kadi', 'Lounis', 'Haddad', 'Zerrouki',
            'Belkacem', 'Rahmani', 'AitAhmed', 'Mokrani', 'Hamdi', 'Toufik'
        ];

        $prenoms = [
            'Abdelkader', 'Noureddine', 'Samir', 'Karim', 'Walid', 'Farid',
            'Nabil', 'Rachid', 'Sofiane', 'Hakim', 'Amar', 'Younes'
        ];

        $grades = ['Professeur', 'Maître de Conférences', 'Chargé de Cours', 'Assistant'];

        for ($i = 1; $i <= 65; $i++) {
            $dept = $departements->random();

            $nom = $noms[array_rand($noms)];
            $prenom = $prenoms[array_rand($prenoms)];

            Professeur::create([
                'nom' => $nom,
                'prenom' => $prenom,
                'date_naissance' => date('Y-m-d', strtotime('-' . rand(30, 60) . ' years')),
                'email' => strtolower($prenom) . '.' . strtolower($nom) . $i . '@univ.dz',
                'grade' => $grades[array_rand($grades)],
                'id_dept' => $dept->id_dept,
                'nb_surveillances_periode' => 0,
            ]);
        }
    }
}
