<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Especialidad;

class EspecialidadesSeeder extends Seeder
{
    public function run(): void
    {
        $especialidades = [
            "Cardiología",
            "Neumología",
            "Gastroenterología",
            "Neurología",
            "Reumatología",
            "Traumatología",
            "Ortopedia",
            "Ginecología",
            "Urología",
            "Nefrología",
            "Psiquiatría",
            "Psicología",
            "Dermatología",
            "Medicina Interna",
            "Endocrinología",
            "Pediatría",
            "Otorrinolaringología (ORL)",
            "Oftalmología",
            "Hematología",
            "Infectología",
            "Oncología",
            "Geriatría",
            "Cirugía General",
            "Cirugía Plástica y Reconstructiva",
            "Anestesiología",
            "Radiología",
            "Medicina Física y Rehabilitación (Fisiatría)",
            "Alergología e Inmunología",
            "Toxicología",
            "Genética Médica",
            "Medicina del Deporte",
            "Medicina del Trabajo (Laboral)",
            "Urgencias y Emergencias Médicas",
            "Patología Clínica",
            "Neonatología",
            "Neurocirugía",
            "Cirugía Vascular",
            "Cirugía Torácica"
        ];

        foreach ($especialidades as $nombre) {
            Especialidad::create(['nombre' => $nombre]);
        }
    }
}
