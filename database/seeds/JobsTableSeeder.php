<?php

use Illuminate\Database\Seeder;

use App\Library\General;
use App\Library\SendEmail;
use App\Models\User;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();        
        $user = DB::table('users')->insertGetId([
            'name' => "Saurav Kuwar",
            'email' => "kuwarsaurav21@gmail.com",
            'password' => bcrypt('sau123[]')
        ]);
        $userDetail = User::where('id', $user)->first();

        DB::table('jobs')->delete();
    	// Seeding Jobs Table
        $linkId = General::generateVerificationToken();
        $uiUxDesigner = DB::table('jobs')->insertGetId([
            'user_id' => $user,
            'title' => "Jr. UI/UX Designers",
            'description' => "F1Soft International Pvt. Ltd. is a company working in the field of software development and IT services since 2004. Our acclaimed products include Mobile Banking System, Internet Banking System, Tab Banking System, Cards Management System, Digital Wallet and Online Payment Gateway. We are the pioneers in introducing mobile banking and mobile financial services in Nepal and lead the market with almost 90% of Nepal’s financial institutions using at least one of our transaction banking products. We currently employ over 200 people with expertise and competence in technology and management. Among us are skilled engineers, innovators and creative thinkers eager to disrupt traditional access to financial services by inventing solutions that are much more efficient, affordable and real-time.",
            'link_id' => $linkId
        ]);
        SendEmail::sendEmailOnJobCreation($userDetail, $linkId, $uiUxDesigner);

        $linkId = General::generateVerificationToken();
        $forntEndEngineer = DB::table('jobs')->insertGetId([
            'user_id' => $user,
            'title' => "Frontend Engineer",
            'description' => "Javra Software is seeking a Frontend Engineer ready to make a long term commitment to an excellent career in Nepal. You will work as part of our world class outsourcing team developing desktop and web software applications for international customers.",
            'link_id' => $linkId
        ]);
        SendEmail::sendEmailOnJobCreation($userDetail, $linkId, $forntEndEngineer);

        $linkId = General::generateVerificationToken();
        $javaDeveloper = DB::table('jobs')->insertGetId([
            'user_id' => $user,
            'title' => "Java Developer",
            'description' => "Led by a mix of young and experienced people, Hrevert aims to grow itself as one of the Web Application Development and Software-as-a-Service (SAAS) providers such that its services effectively reduce the total cost of ownership and operation (TCO&O) of its prospective customers.",
            'link_id' => $linkId
        ]);
        SendEmail::sendEmailOnJobCreation($userDetail, $linkId, $javaDeveloper);

        $linkId = General::generateVerificationToken();
        $itOficer = DB::table('jobs')->insertGetId([
            'user_id' => $user,
            'title' => "Sr. IT Officer",
            'description' => "One of the must trusted names in the country, is a premier business conglomerate, with well entrenched business presence in Health and Education related IT products and services. Besides, it has achieved position of market leadership on diversified business lines. The Group has a highly specialized infrastructure across the region with a perfected in-house expertise in conducting viable business activities in these complex markets. We have been awarded with a number of accolades for our unrelenting quality service to the industry.",
            'link_id' => $linkId
        ]);
        SendEmail::sendEmailOnJobCreation($userDetail, $linkId, $itOficer);

        $linkId = General::generateVerificationToken();
        $databaseEngineer = DB::table('jobs')->insertGetId([
            'user_id' => $user,
            'title' => "Database Engineer",
            'description' => " a wholly owned subsidiary of Verisk Health based in Boston, USA, is an off shoring firm. It is a leading provider of medical reporting and data analytics solutions. We design, build and maintain turnkey products using the latest technologies and also provide web-based solutions to help companies increase revenues and decrease operating costs. Verisk IT is a CMMI level 3 certified company that has an extensive engineering team of over 300 engineers working in leading edge technologies that serve enterprise level solutions to global customers.",
            'link_id' => $linkId
        ]);
        SendEmail::sendEmailOnJobCreation($userDetail, $linkId, $databaseEngineer);

        DB::table('skills')->delete();
        //Seedings Skills Table
        DB::table('skills')->insert([
            'job_id' => $uiUxDesigner,
            'title' => "Possess knowledge in Dreamweaver, Photoshop, HTML5, Flash, JavaScript, CSS, JQuery.",
        ]);
        DB::table('skills')->insert([
            'job_id' => $uiUxDesigner,
            'title' => "Experience designing UI / UX for web and mobile applications.",
        ]);
        DB::table('skills')->insert([
            'job_id' => $uiUxDesigner,
            'title' => "Possess understanding of image resolution, conversions and color.",
        ]);
        DB::table('skills')->insert([
            'job_id' => $uiUxDesigner,
            'title' => "Able to rapidly prototype (sketch, paper, interactive) design concepts.",
        ]);
        DB::table('skills')->insert([
            'job_id' => $uiUxDesigner,
            'title' => "Communication skills.",
        ]);
        DB::table('skills')->insert([
            'job_id' => $uiUxDesigner,
            'title' => "Experience with mobile app design for iOS/Android is a PLUS.",
        ]);
        //
        DB::table('skills')->insert([
            'job_id' => $forntEndEngineer,
            'title' => "Application development using JavaScript, HTML5, CSS3, JSON, AJAX  and leading JavaScript frameworks (jQuery, prototype)",
        ]);
        DB::table('skills')->insert([
            'job_id' => $forntEndEngineer,
            'title' => "Comfortable working with web standards, CSS based design and cross-browser compatibility",
        ]);
        DB::table('skills')->insert([
            'job_id' => $forntEndEngineer,
            'title' => "Deadline-oriented with the ability to prioritize multiple projects.",
        ]);
        //
        DB::table('skills')->insert([
            'job_id' => $javaDeveloper,
            'title' => "Minimum 3 years of experience in related field",
        ]);
        DB::table('skills')->insert([
            'job_id' => $javaDeveloper,
            'title' => "Good knowledge of Java and popular frameworks",
        ]);
        DB::table('skills')->insert([
            'job_id' => $javaDeveloper,
            'title' => "Excellent team player",
        ]);
        //
        DB::table('skills')->insert([
            'job_id' => $itOficer,
            'title' => "Work experience as IT Officer on School/College are encouraged to apply",
        ]);
        DB::table('skills')->insert([
            'job_id' => $itOficer,
            'title' => "Work experience on Hospital sector with software knowledge will be highly entertained",
        ]);
        DB::table('skills')->insert([
            'job_id' => $itOficer,
            'title' => "Good understanding of database technologies, specifically PGSQL, ORACLE, MS SQL",
        ]);
        //
        DB::table('skills')->insert([
            'job_id' => $databaseEngineer,
            'title' => "This is an open position for both Software Engineers and Senior Software Engineers. 2-3 years of hands on experience will be required for Software Engineers and more than 4 years of experience for Senior Software level.",
        ]);
        DB::table('skills')->insert([
            'job_id' => $databaseEngineer,
            'title' => "Hands on knowledge in T-SQL/PL-SQL, Stored Procedures, Triggers, Functions and Indexes.",
        ]);
        DB::table('skills')->insert([
            'job_id' => $databaseEngineer,
            'title' => "Sound knowledge on SQL optimization",
        ]);
        DB::table('skills')->insert([
            'job_id' => $databaseEngineer,
            'title' => "Ability to work in a team as well as independently drive the project.",
        ]);
        DB::table('skills')->insert([
            'job_id' => $databaseEngineer,
            'title' => "At least 1 year of professional work experience in Oracle or MS-SQL.",
        ]);

    }
}
