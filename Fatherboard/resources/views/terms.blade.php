<x-lowlayout>
    <x-slot:head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href={{asset('css/aboutus.css')}}>

    <title>Terms and Conditions Page</title>
    </x-slot:head>
    
    <style>
    .return{
        padding-bottom: 10px;
        color: black;
        font-weight: bold;
        text-decoration: underline;
}
    </style>

    <x-header>
    </x-header>
    <h1>Terms and Conditions</h1>

    <div class = "terms-containerbox">
        <section>
            <p>By signing up to use this website, you agree to be bound by these Terms and Conditions. If you disagree to the terms and conditions, refrain from using the Fatherboard website.</p>
            <br/>
        </section>
        
        <section>
            <h2>1. Use of the Website</h2>
            <p>You agree to use this website for lawful purposes and in a way that does not break/ violate the rights of others.</p>
        </section>
        
        <br/>

        <section>
            <h2>2. Intellectual Property</h2>
            <p>All content on this website is under protection by copyright laws.</p>
        </section>
        
        <br/>

        <section>
            <h2>3. User Accounts</h2>
            <p>Upon creating an account on our website, you are responsible for maintaining the confidentiality of your login details.</p>
        </section>
        
        <br/>

        <section>
            <h2>4. Limitation of Liability</h2>
            <p>We are not responsible for any damages arising from your use of this website unless stated otherwise.</p>
        </section>
        
        <br/>

        <section>
            <h2>5. Privacy Policy</h2>
            <p>Your use of this website is governed by our Privacy Policy, which details how the website collects and uses your data. Data collected will be used strictly following lawful procedure. The website will be liable for any data leaks.</p>
        </section>
        
        <br/>

        <section>
            <h2>6. Changes to Terms</h2>
            <p>We have the right to update these Terms and Conditions at any time period. It is your responsibility, as the user, to review them.</p>
            <br/>
            <a class = "return" href="{{route('register')}}">return to register</a>
        </section>

    </div>
    


</x-lowlayout>