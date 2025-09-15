
namespace Database\Seeders;

use App\Models\PlnOffice;
use Illuminate\Database\Seeder;

class PlnOfficeSeeder extends Seeder
{
    public function run()
    {
        // Kantor Pusat
        $pusat = PlnOffice::create([
            'office_id' => 'PLN-001',
            'office_name' => 'Kantor Pusat PLN Jakarta',
            'address' => 'Jl. Trunojoyo Blok M I/135, Kebayoran Baru',
            'city' => 'Jakarta Selatan',
            'province' => 'DKI Jakarta',
            'office_type' => 'Pusat',
            'parent_office' => null,
            'latitude' => -6.2441,
            'longitude' => 106.7991
        ]);

        // SBU Sumatera Utara
        PlnOffice::create([
            'office_id' => 'PLN-002',
            'office_name' => 'PLN SBU Sumatera Utara',
            'address' => 'Jl. Imam Bonjol No. 1',
            'city' => 'Medan',
            'province' => 'Sumatera Utara',
            'office_type' => 'SBU',
            'parent_office' => $pusat->id,
            'latitude' => 3.5952,
            'longitude' => 98.6722
        ]);

        // Kantor Perwakilan Banda Aceh
        PlnOffice::create([
            'office_id' => 'PLN-003',
            'office_name' => 'PLN Kantor Perwakilan Banda Aceh',
            'address' => 'Jl. T. Panglima Polem No. 1',
            'city' => 'Banda Aceh',
            'province' => 'Aceh',
            'office_type' => 'KP',
            'parent_office' => $pusat->id,
            'latitude' => 5.5483,
            'longitude' => 95.3238
        ]);

        // SBU Jakarta Banten
        PlnOffice::create([
            'office_id' => 'PLN-004',
            'office_name' => 'PLN SBU Jakarta Banten',
            'address' => 'Jl. Jend. Sudirman No. 1',
            'city' => 'Jakarta Pusat',
            'province' => 'DKI Jakarta',
            'office_type' => 'SBU',
            'parent_office' => $pusat->id,
            'latitude' => -6.2088,
            'longitude' => 106.8456
        ]);
    }
}
