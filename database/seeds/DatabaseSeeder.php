<?php

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
        $this->call(SecretariaSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(RolAdministrativoSeeder::class);
        $this->call(ReporteSeeder::class);
        $this->call(IncidenciaReporteSeeder::class);
        $this->call(SeguimientoReporteSeeder::class);
        $this->call(BenApoyoSeeder::class);
        $this->call(BenBeneficiarioSeeder::class);
        $this->call(BenApoyoSecretariaSeeder::class);
        $this->call(BenSolicitudesSeeder::class);
    }
}
