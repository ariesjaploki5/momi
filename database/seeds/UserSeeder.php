<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Model\Files\Condition;
use App\Model\Files\Test;
use App\Model\Files\Question;
use App\Model\Users\Admin;
use App\Model\Users\Candidate;
use App\Model\Users\Donor;
use App\Model\Users\Recipient;
use App\Model\Users\Staff;
use App\Model\Users\Nurse;
use App\Model\Users\Doctor;
use App\Model\Users\Client;
use Carbon\Carbon;


class UserSeeder extends Seeder
{

    public function run()
    {
        $user1 = User::create([
            'email' => 'admin@gmail.com',
            'type' => 'admin',
            'password' => Hash::make('admin'),
            'email_verified_at' => Carbon::now(),
        ]);

        $admin = Admin::create([
            'user_id' => $user1->id,
        ]);

        $user2 = User::create([
            'email' => 'doctor@gmail.com',
            'type' => 'doctor',
            'password' => Hash::make('doctor'),
            'email_verified_at' => Carbon::now(),
        ]);

        $doctor = Doctor::create([
            'user_id' => $user2->id,
        ]);

        $user3 = User::create([
            'email' => 'nurse@gmail.com',
            'type' => 'nurse',
            'password' => Hash::make('nurse'),
            'email_verified_at' => Carbon::now(),
        ]);

        $nurse = Nurse::create([
            'user_id' => $user3->id,
        ]);


        $questions = Question::insert([
            [
                'text' => 'Are you willing to donate breast milk on a regular basis for a minimum period of 6 months? (Gusto mo bang magbigay ng gatas nang regular sa loob ng 6 na buwan?)',
                'selected' => 1,
            ],
            [
                'text' => 'Will you be allowed by your husband to donate your breast milk to the Human Milk Bank? (Papayagan ka ba ng iyong asawa na magbigay ng iyong gatas sa Human Milk Bank?)',
                'selected' => 1,
            ],
            [
                'text' => 'Have you donated breast milk before? (Nakapagbigay ka na ba ng iyong gatas dati?)',
                'selected' => 1,
            ],
            [
                'text' => 'Did you have a normal pregnancy and delivery for your most recent pregnancy? (Normal ba ang panganganak mo sa huli mong anak?)',
                'selected' => 0,
            ],
            [
                'text' => 'Do you have any acute or chronic infection, systemic disorders, tuberculosis or history of hepatitis? (Mayroon ka bang kahit anong impeksyon o sakit? Nagkaroon ng sakit sa atay dati?) ',
                'selected' => 0,
            ],
            [
                'text' => 'Have you received any blood transfusion or other blood products within the last 12 months? (Ikaw ba ay nasalinan ng dugo o kahit anung produkto mula sa dugo nitong nakaraan 12 buwan?) ',
                'selected' => 0,
            ],
            [
                'text' => 'Have you received any organ or tissue transplant within the last 12 months? (Ikaw ba ay nakatanggap ng parte ng katawan mula sa ibang tao nitong nakaraang 12 buwan?) ',
                'selected' => 0,
            ],
            [
                'text' => 'Do you regularly use over-the-counter medications or systemic preparations such as replacement hormones and some birth control hormones? (Regular ka bang gumagamit ng mga gamut gaya ng mga hormones or pills?) ',
                'selected' => 0,
            ],
            [
                'text' => 'Do you use megadose vitamins or pharmacologically active herbal preparations? (Gumagamit ka ba ng mga “megadose vitamins” o mga “herbal drugs?)',
                'selected' => 0,
            ],
            [
                'text' => 'Do you use illicit drugs? (Gumagamit ka ba ng ipinagbawal na gamot?)',
                'selected' => 0,
            ],
            [
                'text' => 'Have you had breast augmentation surgery, using silicone Breast implants? (Ikaw ba ay naoperahan na sa suso at nalagyan ng “silicone” o artipisyal na breast implants?)',
                'selected' => 0,
            ],
            [
                'text' => 'Have you had syphilis, HIV, herpes, or any sexually-transmitted disease? (Nagkaroon ka na ba ng mga sakit na nakukuha sa pakikipagtalik/sex?)',
                'selected' => 0,
            ],
            [
                'text' => 'Do you have multiple sex partners? (Nagkaroon ka na ba ng karanasang makipagtalik sa hindi lang iisang lalaki?)',
                'selected' => 0,
            ],

            [
                'text' => 'Have you had a tattoo applied or have had accidental needlestick or contact with someone else’s blood? (Nagpalagay ka na ba ng tattoo, naturukan ng karayom nang hindi sinasadya o nadikit sa dugo ng ibang tao?)',
                'selected' => 0,
            ],
            [
                'text' => 'Is your child healthy? (Malusog ba ang iyong anak?)',
                'selected' => 0,
            ],
            [
                'text' => 'Was your child delivered full term? (Ipinanganak ba ang anak mo na husto sa buwan?)',
                'selected' => 0,
            ],
            [
                'text' => 'Are you exclusively breastfeeding your child? (Puro gatas mo ba ang binibigay mo sa anak mo at walang halong ibang formula/gatas?)',
                'selected' => 0,
            ],
        ]);

        $tests = Test::insert([
            [
                'name' => 'HIV I',
                'selected' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'HIV II',
                'selected' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'HBV (Hepatitis B)',
                'selected' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'HCV (Hepatitis C)',
                'selected' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'HTLV I (Human T-Cell Lymphotropic Viruses I)',
                'selected' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'HTLV II  (Human T-Cell Lymphotropic Viruses II)',
                'selected' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Syphilis',
                'selected' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'TB (Tuberculosis)',
                'selected' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'CMV (Cytomegalovirus –IgG and IgM)',
                'selected' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'WNV (West Nile Virus –IgA and IgM)',
                'selected' => 1,
                'created_at' => Carbon::now(),
            ],
        ]);

        $conditions = Condition::insert([
            [
                'name' => 'Chondrosarcoma', 'type' => 'disease'
            ],
            [
                'name' => "Ewing's sarcoma", 'type' => 'disease'
            ],
            [
                'name' => 'Malignant fibrous histiocytoma of bone/osteosarcoma', 'type' => 'disease'
            ],
            [
                'name' => 'Osteosarcoma', 'type' => 'disease'
            ],
            [
                'name' => 'Rhabdomyosarcoma', 'type' => 'disease'
            ],
            [
                'name' => 'Astrocytoma', 'type' => 'disease'
            ],
            [
                'name' => 'Brainstem glioma', 'type' => 'disease'
            ],
            [
                'name' => 'Pilocytic astrocytoma', 'type' => 'disease'
            ],
            [
                'name' => 'Ependymoma', 'type' => 'disease'
            ],
            [
                'name' => 'Primitive neuroectodermal tumor', 'type' => 'disease'
            ],
            [
                'name' => 'Cerebellar astrocytoma', 'type' => 'disease'
            ],
            [
                'name' => 'Glioma', 'type' => 'disease'
            ],
            [
                'name' => 'Medulloblastoma', 'type' => 'disease'
            ],

            [
                'name' => 'Neuroblastoma', 'type' => 'disease'
            ],
            [
                'name' => 'Oligodendroglioma', 'type' => 'disease'
            ],
            [
                'name' => 'Pineal astrocytoma', 'type' => 'disease'
            ],
            [
                'name' => 'Visual pathway and hypothalamic glioma', 'type' => 'disease'
            ],

        ]);
    }
}
