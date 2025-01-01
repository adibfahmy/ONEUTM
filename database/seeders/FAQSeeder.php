<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FAQSeeder extends Seeder
{
    public function run()
    {
        // Insert FAQs into the faqs table
        DB::table('faqs')->insert([
            [
                'question' => 'What is Student Grab?',
                'answer' => 'Student Grab is a service that connects students with drivers to help them with transportation around the university campus. Whether you need a ride for a quick errand or to get to class, Student Grab is here to assist!',
            ],
            [
                'question' => 'How can I book a ride with Student Grab?',
                'answer' => 'Simply log in to the Student Grab platform, choose your pickup location and destination, and book your ride. A driver will be assigned to you, and you will receive real-time updates on your ride’s status.',
            ],
            [
                'question' => 'What is Marketplace Bundle?',
                'answer' => 'The Marketplace Bundle is a special package that allows students to buy or sell items like textbooks, electronics, and other campus essentials. It’s an easy and safe way to exchange items with fellow students.',
            ],
            [
                'question' => 'How do I use Marketplace Bundle?',
                'answer' => 'To use the Marketplace Bundle, create an account on the marketplace platform, browse listings or post your own item for sale. Once you find a product you like, contact the seller through the platform to arrange a transaction.',
            ],
            [
                'question' => 'What is the Parcel Service?',
                'answer' => 'The Parcel Service helps students send and receive parcels around campus and beyond. Whether you need to send a package to a friend or receive an online order, our service ensures it’s done smoothly.',
            ],
            [
                'question' => 'How can I send a parcel using the Parcel Service?',
                'answer' => 'To send a parcel, simply log into the Parcel Service platform, enter the details of your package (weight, dimensions, destination), and make a payment. Your parcel will be picked up and delivered to the recipient’s location.',
            ],
            [
                'question' => 'What is Laundry Service?',
                'answer' => 'Our Laundry Service allows students to have their clothes cleaned and delivered to their doorsteps. No more worrying about laundry day; we offer convenient and affordable laundry options tailored for busy students.',
            ],
            [
                'question' => 'How do I use the Laundry Service?',
                'answer' => 'Log in to the Laundry Service platform, select your laundry preferences (wash, dry, fold), schedule a pickup time, and pay through the app. Your clean laundry will be delivered to you at the scheduled time.',
            ],
            [
                'question' => 'Is there a minimum order for the Laundry Service?',
                'answer' => 'There is no minimum order for the Laundry Service. However, we do offer discounts for bulk orders. Check the pricing page for more details!',
            ],
            [
                'question' => 'Can I track my parcel or laundry order?',
                'answer' => 'Yes! Both the Parcel Service and Laundry Service offer real-time tracking for your orders. You can track your parcel or laundry through your account on the platform.',
            ],
            [
                'question' => 'Is there a student discount for these services?',
                'answer' => 'Yes, we offer exclusive student discounts for all our services (Student Grab, Marketplace Bundle, Parcel Service, and Laundry Service). Make sure you verify your student status to avail of the discounts.',
            ],
            [
                'question' => 'How do I contact customer support?',
                'answer' => 'If you need assistance, you can reach out to customer support via our chat system, available on all service platforms. Alternatively, you can email us at support@oneutm.com.',
            ],
        ]);
    }
}
