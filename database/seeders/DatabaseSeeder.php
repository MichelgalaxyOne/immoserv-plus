<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Service;
use App\Models\Demande;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Administrateur',
            'email'    => 'admin@immo.com',
            'password' => bcrypt('admin123'),
            'role'     => 'admin',
        ]);

        // Prestataires
        $prest1 = User::create([
            'name'     => 'Jean Koffi',
            'email'    => 'jean@immo.com',
            'password' => bcrypt('password'),
            'role'     => 'prestataire',
        ]);

        $prest2 = User::create([
            'name'     => 'Marie Adjobi',
            'email'    => 'marie@immo.com',
            'password' => bcrypt('password'),
            'role'     => 'prestataire',
        ]);

        // Clients
        $client1 = User::create([
            'name'     => 'Paul Agossou',
            'email'    => 'paul@immo.com',
            'password' => bcrypt('password'),
            'role'     => 'client',
        ]);

        $client2 = User::create([
            'name'     => 'Ines Dossou',
            'email'    => 'ines@immo.com',
            'password' => bcrypt('password'),
            'role'     => 'client',
        ]);

        // Catégories
        $cats = [
            'Vente immobilière',
            'Location',
            'Gestion locative',
            'Estimation immobilière',
            'Construction',
            'Rénovation',
            'Déménagement',
        ];

        foreach ($cats as $nom) {
            Categorie::create(['nom' => $nom]);
        }

        // Annonces
        $services = [
            [
                'user_id'      => $prest1->id,
                'categorie_id' => 1,
                'titre'        => 'Villa moderne à vendre à Cotonou',
                'description'  => 'Belle villa de 4 chambres avec piscine, jardin et parking. Quartier résidentiel calme.',
                'localisation' => 'Cotonou, Akpakpa',
                'prix'         => 45000000,
                'latitude'     => 6.3654,
                'longitude'    => 2.4183,
                'statut'       => 'actif',
            ],
            [
                'user_id'      => $prest1->id,
                'categorie_id' => 2,
                'titre'        => 'Appartement F3 à louer - Fidjrossè',
                'description'  => 'Appartement meublé 3 pièces, climatisé, proche de la plage. Idéal pour famille.',
                'localisation' => 'Cotonou, Fidjrossè',
                'prix'         => 150000,
                'latitude'     => 6.3702,
                'longitude'    => 2.3931,
                'statut'       => 'actif',
            ],
            [
                'user_id'      => $prest2->id,
                'categorie_id' => 5,
                'titre'        => 'Construction maison clé en main',
                'description'  => 'Service complet de construction. Devis gratuit. Plus de 10 ans d\'expérience.',
                'localisation' => 'Porto-Novo',
                'prix'         => 12000000,
                'latitude'     => 6.4969,
                'longitude'    => 2.6289,
                'statut'       => 'actif',
            ],
            [
                'user_id'      => $prest2->id,
                'categorie_id' => 4,
                'titre'        => 'Estimation immobilière professionnelle',
                'description'  => 'Évaluation de votre bien par un expert certifié. Rapport détaillé fourni.',
                'localisation' => 'Cotonou, Cadjehoun',
                'prix'         => 50000,
                'latitude'     => 6.3574,
                'longitude'    => 2.3805,
                'statut'       => 'actif',
            ],
            [
                'user_id'      => $prest1->id,
                'categorie_id' => 6,
                'titre'        => 'Rénovation et décoration intérieure',
                'description'  => 'Transformation complète de votre intérieur. Peinture, carrelage, faux plafond.',
                'localisation' => 'Cotonou, Gbèdjromèdé',
                'prix'         => 800000,
                'latitude'     => 6.3601,
                'longitude'    => 2.4105,
                'statut'       => 'actif',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // Demandes
        Demande::create([
            'client_id'  => $client1->id,
            'service_id' => 1,
            'message'    => 'Bonjour, je suis intéressé par cette villa. Pouvez-vous me contacter ?',
            'statut'     => 'acceptee',
        ]);

        Demande::create([
            'client_id'  => $client2->id,
            'service_id' => 2,
            'message'    => 'Est-ce que l\'appartement est disponible pour le mois prochain ?',
            'statut'     => 'en_attente',
        ]);

        Demande::create([
            'client_id'  => $client1->id,
            'service_id' => 3,
            'message'    => 'Je voudrais construire une maison de 3 chambres. Quel est le délai ?',
            'statut'     => 'en_attente',
        ]);
    }
}