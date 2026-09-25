<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'title' => 'Property Management ',
            'description' => 'Rent collection and maintenance of a property can be a tedious
            task when left to an individual owner. We ofer diligent, property
            management services.
            Almost every real estate investor desires a satisfactory income
            from their properties without the inconvenience of having to
            manage and attend to it.
            Quick rent collection 
             Structure the investment to ensure maximum return to
            the property owners at all times. 
             Undertaking frequent thorough inspections of the
            premises and advising owners on maintenance or
            improvement programs 
             Negotiating and administering maintenance and service
            contracts based on competitive tendering 
             Making quick repairs to the managed property on
            behalf of the owners 
             Reviewing and renewing rents and tenancy conditions
            as per market conditions/owner’s returns 
            Advising clients on prevailing market conditions 
             Deal with any legal issues/litigation on the tenant
            occupancy conficts on behalf of the owners
             Provide advisory on property acquisitions, Return on
            Investment from Purchase of the property; Sell the
            property on behalf of the owners. 
            '
        ]);

        Service::create([
            'title' => ' Property Development ',
            'description' => 'We work closely with the client in the development process and
            provide the link between the developer and the target market.
            We see the development from its initiation stage to its
            completion. 
            This involves the following stages: 
             Recommendation on nature and scope of project 
             Creation of fnancial structure and joint venture options as
            well as viability studies 
             Appointment and briefng of various consultants for the
            project 
             Input and co -ordination with the design team to formulate
            the appropriate concept. 
             Co-ordination of the tender process for construction. 
             Liaison with advocates to create required legal structure.
             Provision of fnancial management services 
             Monitoring of the construction process'
        ]);

        Service::create([
            'title' => 'Marketing and sales service 
            ',
            'description' => 'Giving a property the exposure it deserves through several online
            platforms such as the social media to fnd quality tenants or to
            sell for the right price requires enormous commitment. We give
            our clients access to substantial exposure and to our pool of highquality tenants and buyers thus reducing the turnover time for
            their properties and achieving a better price.
            Our Work involves: 
             Designing attractive color brochures for the property 
             On site marketing via signboards, banners and the stationing
            of a caretaker where applicable 
             Hosting an open house scheme (where applicable) 
             Media marketing through newspapers, property magazines
            and other publications
             Internet marketing through our
            prominent website and blogs
             Identifcation and vetting of
            potential tenants / buyers 
             Finalizing sale / rental of the
            property on the best terms
             Follow-through of all deals
            including liaison with third parties
            such as advocates. 
            Properties on our Sales and Rental Portfolio include undeveloped
            land, residential and commercial properties.
            '
        ]);

        Service::create([
            'title' => ' Investment Planning & Advisory ',
            'description' => 'We do ofer advisory and consultancy services for investment in
            Alternative Investments (Real Estate Inclusive) as well as in
            traditional Investments (Equities & Fixed Income). 
            We do this by collaboration with established Financial Institutions.
            These include: 
            -Unit Trust Investments including:-Money Market Fund, Equity
            Fund, Balanced Fund or Bond plus Fund.
            -Cash Management Solution:-In case you want great returns and
            still have quick access to your funds.
            -Investment in Real Estate Investment Trusts (REITS)
            '
        ]);

    }
}
