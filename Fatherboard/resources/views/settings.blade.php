<x-lowlayout>


    <x-slot:head>
        <link rel="stylesheet" href={{ asset('css/settings.css') }}>
        <script src={{ asset('js/settings.js') }}></script>
        <link rel="stylesheet" href={{asset('css/aboutus.css')}}>

        <title>Settings</title>
    </x-slot:head>

    <div class="content" id="order-info" hidden>
        <div>
        <?php
        if (isset($items) && count($items)> 0)
        {
            foreach($items as $order)
            {

                ?>
                <br>
                <h2>Order</h2>
                <h2 class="order_price">£ {{$order["price"]}}</h2>

                <br>
                <?php
                foreach($order["elements"] as $info)
                {
                ?>

                <p >{{$info}}</p>
                <?php
                }
            }
        }
        else
        {
            ?>
            <h2>You have not bought any items</h2>
            <?php
        }
        ?>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <template id="address-template">
        <style>
            p
            {
                margin:0;
                padding:0;
            }

            </style>


        <p id="Country"><slot name="Country">Unknown Country</slot></p>
        <p id="City"><slot name="City">Unknown City</slot></p>
        <p id="AddressLine"><slot name="AddressLine">Unknown Address</slot></p>
        <p id="PostCode"><slot name="PostCode">Unknown PostCode</slot></p>


        <button name="remove-item">-</button>
    </template>


    <template id="personal-template">
        <style>
            p
            {
                margin:0;
                padding:0;
            }
        </style>
        <label>Email:</label>
        <b><slot name="Email">Unknown Email</slot></b>
        <button version="Email" class="update_personal_button">Update</button>

        <br>
        <label>First Name:</label>
        <b><slot name="FirstName">Unknown First Name</slot></b>
        <button version="First Name" class="update_personal_button">Update</button>

        <br>

        <label>Last Name:</label>
        <b><slot name="LastName">Unknown Last Name</slot></b>
        <button version="Last Name" class="update_personal_button">Update</button>

        <br>

        <label>Password:</label>
        <b><slot name="Password">Unknown Password</slot></b>
        <button version="Password" class="update_personal_button">Update</button>


        <br>

    </template>
{{--
    <template id="template_add_address_box">

    </template> --}}



    <x-header>

    </x-header>

    <div class="content" id="message-info" hidden>
        <?php
        if (isset($messages))
        {
        foreach($messages as $x)
        {?>
        <div class="message">
            <p>{{$x["Message"]}}</p>
            <p>{{$x["Email"]}}</p>

        </div>

        <?php
        }}
        ?>
    </div>
    <div id="update_personal">
    <form action="/update/personal" method="POST" id="update_personal_form">
        <meta name="type" content="">
        <input type="text" name="personal_text" placeholder="change" id="personal_text"></input>
        <input type="submit" name="submit" id="update_personal_submit" value="Submit"/>
    </form>
    </div>
    <div id="add_address_box"  hidden>
    <div>

    </div>
        <form id="add_address_form" method="POST" action="/add/address">
            <div>
            <label for="Country">Country</label>

            <select id="inp_country">
                <option>UK</option>
                <option>USA</option>
                <option>France</option>
                <option>Germany</option>
                <option>Spain</option>
            </select>
        </div>

        <div>
            <label for="City">City</label>
            <input type="text" id="inp_city" name="City"></input>
        </div>

        <div>

            <label for="City">Address Line</label>

            <input type="text" id="inp_addrLine" name="Address Line"></input>
        </div>

        <div>
            <label for="PostCode">Post Code</label>
            <input type="text" id="inp_postCode" name="PostCode"></input>
        </div>

        <div>
            <input type="submit" name="add_address_button" id="add_address_submit" value="Add" target=""></input>
        </div>
        </form>

    </div>
    <main id="setting-container">



    <div id="settings" >
        <div id="currentBar">
        </div>
        <ul id="option_container">
            <li>
                <button class="option" id="button_personal">Personal
                <img class="option_icon" src="{{asset("/images/setting_images/user.png")}}">
            </button>

            </li>
            <li>
                <button class="option" id="button_address">Address
                <svg viewBox="0 0 24 24" class="option_icon" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18 9H14M18 12H14M12 15.5C11.7164 14.3589 10.481 13.5 9 13.5C7.519 13.5 6.28364 14.3589 6 15.5M6.2 19H17.8C18.9201 19 19.4802 19 19.908 18.782C20.2843 18.5903 20.5903 18.2843 20.782 17.908C21 17.4802 21 16.9201 21 15.8V8.2C21 7.0799 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V15.8C3 16.9201 3 17.4802 3.21799 17.908C3.40973 18.2843 3.71569 18.5903 4.09202 18.782C4.51984 19 5.07989 19 6.2 19ZM10 9.5C10 10.0523 9.55228 10.5 9 10.5C8.44772 10.5 8 10.0523 8 9.5C8 8.94772 8.44772 8.5 9 8.5C9.55228 8.5 10 8.94772 10 9.5Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </button>

            </li>
            <li>
                <button class="option" id="button_billing">Billing
                <svg class="option_icon" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" stroke-width="3" stroke="#000000" fill="none"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M52.35,57.08H11.65v-50A.11.11,0,0,1,11.81,7l4.11,3.85a.11.11,0,0,0,.13,0L19.35,7a.09.09,0,0,1,.12,0l3.72,3.89a.11.11,0,0,0,.13,0L26.61,7a.09.09,0,0,1,.13,0l2.86,3.87a.1.1,0,0,0,.14,0L33,7a.09.09,0,0,1,.13,0l2.69,3.85a.1.1,0,0,0,.14,0L38.86,7A.1.1,0,0,1,39,7l2.85,3.85a.1.1,0,0,0,.14,0L44.7,7a.09.09,0,0,1,.15,0l2.25,3.84a.09.09,0,0,0,.13,0L52.2,7a.1.1,0,0,1,.15.09Z" stroke-linecap="round"></path><line x1="19.42" y1="43.04" x2="46.02" y2="43.04" stroke-linecap="round"></line><line x1="19.42" y1="49.29" x2="46.02" y2="49.29" stroke-linecap="round"></line><path d="M37.54,33.86H28c-.06,0-.1-.08-.06-.12.66-.7,3.79-4.29,2.59-7.51-1.33-3.59-.47-9.3,6-6.65" stroke-linecap="round"></path><line x1="26.46" y1="26.32" x2="35.39" y2="26.32" stroke-linecap="round"></line></g></svg>
            </button>
            </li>

            <li>
                <button class="option" id="button_history">History
                <svg class="option_icon" height="21px" version="1.1" viewBox="0 0 20 21" width="20px" xmlns="http://www.w3.org/2000/svg" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" xmlns:xlink="http://www.w3.org/1999/xlink"><title/><desc/><defs/><g fill="none" fill-rule="evenodd" id="Page-1" stroke="none" stroke-width="1"><g fill="#000000" id="Core" opacity="0.9" transform="translate(-464.000000, -254.000000)"><g id="history" transform="translate(464.000000, 254.500000)"><path d="M10.5,0 C7,0 3.9,1.9 2.3,4.8 L0,2.5 L0,9 L6.5,9 L3.7,6.2 C5,3.7 7.5,2 10.5,2 C14.6,2 18,5.4 18,9.5 C18,13.6 14.6,17 10.5,17 C7.2,17 4.5,14.9 3.4,12 L1.3,12 C2.4,16 6.1,19 10.5,19 C15.8,19 20,14.7 20,9.5 C20,4.3 15.7,0 10.5,0 L10.5,0 Z M9,5 L9,10.1 L13.7,12.9 L14.5,11.6 L10.5,9.2 L10.5,5 L9,5 L9,5 Z" id="Shape"/></g></g></g></svg>
            </button>
            </li>
            <li>
                <button class="option" id="logout_button">Logout
               <svg class="option_icon" fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M17 16L21 12M21 12L17 8M21 12L7 12M13 16V17C13 18.6569 11.6569 20 10 20H6C4.34315 20 3 18.6569 3 17V7C3 5.34315 4.34315 4 6 4H10C11.6569 4 13 5.34315 13 7V8" stroke="#374151" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
            </button>
            </li>
            <?php

            if ($user["Admin"])
            {
                ?>
            <li>
                <button class="option" id="message_button">Messages</button>
            </li>
            <li>
                <button class="option" id="admin_index_button">Admin Hub</button>
            </li>
            <li>
                <button class="option" id="button_reports">Reports</button>
            </li>
            <?php
            }
            ?>

        </ul>
    </div>
    <personal-element id="personal_element_first" hidden>
        <span slot="Email">{{$user["Email"]}}</span>
        <span slot="Password">{{$user["Password"]}}</span>
        <span slot="FirstName">{{$user["FirstName"]}}</span>
        <span slot="LastName">{{$user["LastName"]}}</span>
    </personal-element>
    <div id="address_container" hidden>    
        <?php
        foreach($addr as $single)
        {
            ?>
        <address-element>
            <p name="address_id" value="{{$single["id"]}}" hidden>{{$single["id"]}}</p>
            <p slot="Country">{{$single["Country"]}}</p>
            <p slot="City">{{$single["City"]}}</p>
            <p slot="PostCode">{{$single["PostCode"]}}</p>
            <p slot="AddressLine">{{$single["Address Line"]}}</p>
        </address-element>
        <?php
        }
        ?>
    </div>

    <div class="content" id="address-info" hidden>
        <h3>Address Information</h3>
        <button id="button_show_address_gui">Add Address</button>

        <?php if ($addr->count() >0)
        {
            foreach ($addr as $key => $value) {
                # code...

            ?>
            <address-element>
                <span slot="Country">{{ $value["Country"] }}</span>
                <span slot="City">{{ $value["City"] }}</span>
                <span slot="AddressLine">{{$value["Address Line"] }}</span>
                <span slot="PostCode">{{$value["PostCode"]}}</span>
                <p name="address_id" value={{ $value["id"] }} hidden></p>
            </address-element>

            <?php }}
        else {
            ?>

            <p>You do not have an address currently.</p>

        <?php
        }
?>
    </div>
    <div id="option-information">
    {{-- <div class="content" id="personal-info">


    </div> --}}


    <personal-element id="personal_element_within" >
        <span slot="Email">{{$user["Email"]}}</span>
        <span slot="Password">{{$user["Password"]}}</span>
        <span slot="FirstName">{{$user["FirstName"]}}</span>
        <span slot="LastName">{{$user["LastName"]}}</span>
    </personal-element>


</div>
    </main>

</x-lowlayout>

