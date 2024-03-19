# Fetch Hotels Data 
The objective of this challenge is to hit an endpoint containing the list of hotels and perform some actions on the result. The challenge must be solved in PHP.

- Based on Repository Design Pattern  

## PHP Version
    8.2
## Framework
    Laravel - V. 11.0

## Packages And Main dependancies Used
<pre>
    <ul>
        <li>php              : ^8.2</li>
        <li>laravel/framework: ^11.0</li>
        <li>...</li>
    </ul>
</pre>

## Project Environment
<pre>
    <code> copy .env.example .env</code>
</pre>

## deployment

   After copping .env file

   1- install composer with required dependancies
   
<pre><code>composer install</code></pre>

   2- Generate App Key 
    
<pre><code>php artisan key:generate</code></pre>

   3- Serve Project on your port
    
<pre><code>php artisan serve --port=1234</code></pre>
   
   3- For Test (Feature & Unit Test)
    
<pre><code>php artisan test</code></pre>

Scrutinizer Build Status badges
<pre><code>https://scrutinizer-ci.com/g/dev3bbas90/HotelsTask/inspections/e39e18c8-2479-48ab-839c-1147b0e968ec<code></pre>

## Hotels Url
    {APP_URL}/hotels
