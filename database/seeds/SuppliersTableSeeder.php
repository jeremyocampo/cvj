<?php

use App\ContactPerson;
use App\Supplier;
use Faker\Generator;
use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::truncate();

        $faker = new Generator();
        $faker->addProvider(new Faker\Provider\en_US\Address($faker));
        $faker->addProvider(new Faker\Provider\en_US\PhoneNumber($faker));
        $faker->addProvider(new Faker\Provider\en_US\Company($faker));
        $faker->addProvider(new Faker\Provider\en_US\Person($faker));
        $faker->addProvider(new Faker\Provider\Internet($faker));
        $faker->addProvider(new Faker\Provider\Lorem($faker));

        for ($i=0; $i < 20; $i++) { 
            $supplier = new Supplier([
                'name' => $faker->company,
                'email' => $faker->email,
                'landline' => $faker->phoneNumber,
                'fax' => $faker->phoneNumber,
                'mobile' => $faker->phoneNumber,
                'payment_terms' => 'test',
                'company_address' => $faker->address,
                'billing_address' => $faker->address,
                'remarks' => $faker->paragraph()
            ]);

            $supplier->save();
        }

        $suppliers = Supplier::all();

        foreach($suppliers as $supplier) {
            for ($i=0; $i < 3; $i++) { 
                $contactPerson = new ContactPerson([
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'landline' => $faker->phoneNumber,
                    'fax' => $faker->phoneNumber,
                    'mobile' => $faker->phoneNumber,
                ]);
                    
                $contactPerson->supplier()->associate($supplier);
                $contactPerson->save();
            }
        }
    }
}
