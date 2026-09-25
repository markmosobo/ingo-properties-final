<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\About;

class AboutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'title' => 'Ingo Property Marketing and Consultancy',
            'description' => "IPMC is a Property Marketing, Development, Management and
            Consultancy Company incorporated in Kenya under the
            Companies Act, Chapter 486.
            Our Services include property Management, Construction &
            Renovation of run-down Property, Marketing Services, Brokerage
            Services in Land, Rental property-Residential & Commercial, Sale
            of land and buildings. 
            As IPMC, we seek to redefne the Real Estate out-of-the-box
            Industry by providing out of the box solutions to provide
            STANDARD services to our clients.
            As of 2016, Kenyan population growth was estimated at 4.2% per
            annum. Based on this growth and rate of urban migration, the
            yearly annual increase in demand for housing in Kenya is
            estimated at 206,000 units annually of which 82,000 are in urban
            areas. According to data from The Kenya Ministry of Housing, it is
            estimated that the formal supply of houses to the market falls
            short by 156,000.
            The frst implication of this shortfall has been rise of slums in
            urban are the as. According to Kenyan 2009 population census,
            over 30% of the country’s population lives in slums. In Nairobi
            alone, it is estimated that over one million out of a city population
            of 3.2 million live in the slums. 
            We live to provide Quality, yet aforrable solutions for these
            challenges and catering for the mass markets.
            We ofer our solutions through Property Development and
            Marketing."
        ]);
    }
}
