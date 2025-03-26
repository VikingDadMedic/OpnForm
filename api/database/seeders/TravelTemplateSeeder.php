<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormTemplate;
use Illuminate\Support\Str;

class TravelTemplateSeeder extends Seeder
{
    public function run()
    {
        // Client Travel Preferences Template
        FormTemplate::create([
            'name' => 'Client Travel Preferences',
            'slug' => 'client-travel-preferences',
            'description' => 'Collect detailed travel preferences from your clients to better plan their trips.',
            'properties' => json_encode([
                'title' => 'Travel Preferences Questionnaire',
                'description' => 'Please share your travel preferences to help us plan your perfect trip.',
                'fields' => [
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'text',
                        'name' => 'full_name',
                        'label' => 'Full Name',
                        'required' => true,
                        'placeholder' => 'Enter your full name'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'email',
                        'name' => 'email',
                        'label' => 'Email Address',
                        'required' => true,
                        'placeholder' => 'your.email@example.com'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'tel',
                        'name' => 'phone',
                        'label' => 'Phone Number',
                        'required' => true,
                        'placeholder' => '(123) 456-7890'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'select',
                        'name' => 'preferred_destinations',
                        'label' => 'Preferred Destinations',
                        'multiple' => true,
                        'required' => true,
                        'options' => [
                            ['label' => 'Europe', 'value' => 'europe'],
                            ['label' => 'Asia', 'value' => 'asia'],
                            ['label' => 'Africa', 'value' => 'africa'],
                            ['label' => 'South America', 'value' => 'south_america'],
                            ['label' => 'North America', 'value' => 'north_america'],
                            ['label' => 'Australia/Oceania', 'value' => 'australia_oceania'],
                            ['label' => 'Caribbean', 'value' => 'caribbean'],
                            ['label' => 'Middle East', 'value' => 'middle_east']
                        ]
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'select',
                        'name' => 'travel_style',
                        'label' => 'Travel Style',
                        'required' => true,
                        'options' => [
                            ['label' => 'Luxury', 'value' => 'luxury'],
                            ['label' => 'Budget-friendly', 'value' => 'budget'],
                            ['label' => 'Adventure', 'value' => 'adventure'],
                            ['label' => 'Cultural', 'value' => 'cultural'],
                            ['label' => 'Relaxation', 'value' => 'relaxation'],
                            ['label' => 'Eco-tourism', 'value' => 'eco']
                        ]
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'select',
                        'name' => 'accommodation_preference',
                        'label' => 'Accommodation Preference',
                        'required' => true,
                        'options' => [
                            ['label' => 'Luxury Hotel', 'value' => 'luxury_hotel'],
                            ['label' => 'Boutique Hotel', 'value' => 'boutique_hotel'],
                            ['label' => 'Resort', 'value' => 'resort'],
                            ['label' => 'Vacation Rental', 'value' => 'vacation_rental'],
                            ['label' => 'Mid-range Hotel', 'value' => 'mid_range_hotel'],
                            ['label' => 'Budget Hotel', 'value' => 'budget_hotel']
                        ]
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'number',
                        'name' => 'budget_per_person',
                        'label' => 'Budget Per Person (USD)',
                        'required' => true,
                        'min' => 500,
                        'placeholder' => '3000'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'textarea',
                        'name' => 'special_interests',
                        'label' => 'Special Interests or Activities',
                        'placeholder' => 'Please list any special interests or activities you enjoy while traveling...'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'textarea',
                        'name' => 'dietary_restrictions',
                        'label' => 'Dietary Restrictions or Preferences',
                        'placeholder' => 'Please list any dietary restrictions or preferences...'
                    ]
                ]
            ])
        ]);

        // Trip Planning Form
        FormTemplate::create([
            'name' => 'Trip Planning Form',
            'slug' => 'trip-planning-form',
            'description' => 'Collect essential details for planning a client\'s specific trip.',
            'properties' => json_encode([
                'title' => 'Trip Planning Details',
                'description' => 'Please provide information about your upcoming trip so we can create the perfect itinerary.',
                'fields' => [
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'text',
                        'name' => 'full_name',
                        'label' => 'Full Name',
                        'required' => true,
                        'placeholder' => 'Enter your full name'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'email',
                        'name' => 'email',
                        'label' => 'Email Address',
                        'required' => true,
                        'placeholder' => 'your.email@example.com'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'date',
                        'name' => 'departure_date',
                        'label' => 'Preferred Departure Date',
                        'required' => true
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'date',
                        'name' => 'return_date',
                        'label' => 'Preferred Return Date',
                        'required' => true
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'text',
                        'name' => 'destination',
                        'label' => 'Destination(s)',
                        'required' => true,
                        'placeholder' => 'e.g., Paris, France; Rome, Italy'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'number',
                        'name' => 'travelers',
                        'label' => 'Number of Travelers',
                        'required' => true,
                        'min' => 1,
                        'placeholder' => '2'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'select',
                        'name' => 'trip_purpose',
                        'label' => 'Purpose of Trip',
                        'required' => true,
                        'options' => [
                            ['label' => 'Leisure', 'value' => 'leisure'],
                            ['label' => 'Anniversary', 'value' => 'anniversary'],
                            ['label' => 'Honeymoon', 'value' => 'honeymoon'],
                            ['label' => 'Family Vacation', 'value' => 'family'],
                            ['label' => 'Business', 'value' => 'business'],
                            ['label' => 'Bleisure (Business + Leisure)', 'value' => 'bleisure']
                        ]
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'checkbox',
                        'name' => 'services',
                        'label' => 'Services Needed',
                        'options' => [
                            ['label' => 'Flights', 'value' => 'flights'],
                            ['label' => 'Accommodations', 'value' => 'accommodations'],
                            ['label' => 'Ground Transportation', 'value' => 'transportation'],
                            ['label' => 'Tours & Activities', 'value' => 'activities'],
                            ['label' => 'Travel Insurance', 'value' => 'insurance'],
                            ['label' => 'Restaurant Reservations', 'value' => 'restaurants']
                        ]
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'textarea',
                        'name' => 'special_requests',
                        'label' => 'Special Requests or Considerations',
                        'placeholder' => 'Any other details or special requests for your trip...'
                    ]
                ]
            ])
        ]);

        // Travel Feedback Form
        FormTemplate::create([
            'name' => 'Travel Feedback Form',
            'slug' => 'travel-feedback-form',
            'description' => 'Collect feedback from clients after their trip.',
            'properties' => json_encode([
                'title' => 'Travel Experience Feedback',
                'description' => 'We value your feedback! Please share your experience to help us improve our service.',
                'fields' => [
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'text',
                        'name' => 'full_name',
                        'label' => 'Full Name',
                        'required' => true,
                        'placeholder' => 'Enter your full name'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'email',
                        'name' => 'email',
                        'label' => 'Email Address',
                        'required' => true,
                        'placeholder' => 'your.email@example.com'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'text',
                        'name' => 'destination',
                        'label' => 'Destination Visited',
                        'required' => true,
                        'placeholder' => 'e.g., Bali, Indonesia'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'date',
                        'name' => 'travel_date',
                        'label' => 'Date of Travel',
                        'required' => true
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'rating',
                        'name' => 'overall_experience',
                        'label' => 'Overall Travel Experience',
                        'required' => true,
                        'max' => 5
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'rating',
                        'name' => 'advisor_service',
                        'label' => 'How would you rate our travel advisory service?',
                        'required' => true,
                        'max' => 5
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'rating',
                        'name' => 'accommodation_quality',
                        'label' => 'Quality of Accommodations',
                        'required' => true,
                        'max' => 5
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'rating',
                        'name' => 'activities_quality',
                        'label' => 'Quality of Tours & Activities',
                        'required' => true,
                        'max' => 5
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'textarea',
                        'name' => 'highlights',
                        'label' => 'Trip Highlights',
                        'placeholder' => 'What were the best parts of your trip?'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'textarea',
                        'name' => 'improvement_areas',
                        'label' => 'Areas for Improvement',
                        'placeholder' => 'What could have been better?'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'checkbox',
                        'name' => 'recommend',
                        'label' => 'Would you recommend our service to others?',
                        'options' => [
                            ['label' => 'Yes', 'value' => 'yes']
                        ]
                    ]
                ]
            ])
        ]);

        // Client Onboarding Form
        FormTemplate::create([
            'name' => 'Client Onboarding Form',
            'slug' => 'client-onboarding-form',
            'description' => 'Collect comprehensive information when onboarding new travel clients.',
            'properties' => json_encode([
                'title' => 'New Client Onboarding',
                'description' => 'Welcome! Please provide the following information to help us better serve your travel needs.',
                'fields' => [
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'text',
                        'name' => 'full_name',
                        'label' => 'Full Name',
                        'required' => true,
                        'placeholder' => 'Enter your full name'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'email',
                        'name' => 'email',
                        'label' => 'Email Address',
                        'required' => true,
                        'placeholder' => 'your.email@example.com'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'tel',
                        'name' => 'phone',
                        'label' => 'Phone Number',
                        'required' => true,
                        'placeholder' => '(123) 456-7890'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'address',
                        'name' => 'address',
                        'label' => 'Mailing Address',
                        'required' => true
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'date',
                        'name' => 'birthdate',
                        'label' => 'Date of Birth',
                        'required' => true,
                        'help_text' => 'Required for booking many travel services'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'text',
                        'name' => 'passport_number',
                        'label' => 'Passport Number',
                        'help_text' => 'If available, for international travel'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'date',
                        'name' => 'passport_expiry',
                        'label' => 'Passport Expiration Date',
                        'help_text' => 'If available, for international travel'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'select',
                        'name' => 'communication_preference',
                        'label' => 'Preferred Method of Communication',
                        'required' => true,
                        'options' => [
                            ['label' => 'Email', 'value' => 'email'],
                            ['label' => 'Phone', 'value' => 'phone'],
                            ['label' => 'Text Message', 'value' => 'text'],
                            ['label' => 'Video Call', 'value' => 'video']
                        ]
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'textarea',
                        'name' => 'travel_history',
                        'label' => 'Past Travel Experience',
                        'placeholder' => 'Please briefly describe your previous travel experiences...'
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'checkbox',
                        'name' => 'travel_interests',
                        'label' => 'Travel Interests',
                        'options' => [
                            ['label' => 'Beach Vacations', 'value' => 'beach'],
                            ['label' => 'Cultural Tours', 'value' => 'cultural'],
                            ['label' => 'Adventure Travel', 'value' => 'adventure'],
                            ['label' => 'Cruises', 'value' => 'cruise'],
                            ['label' => 'Food & Wine Tours', 'value' => 'food_wine'],
                            ['label' => 'Luxury Travel', 'value' => 'luxury'],
                            ['label' => 'Family Travel', 'value' => 'family'],
                            ['label' => 'Solo Travel', 'value' => 'solo']
                        ]
                    ],
                    [
                        'id' => Str::uuid()->toString(),
                        'type' => 'select',
                        'name' => 'referral_source',
                        'label' => 'How did you hear about us?',
                        'required' => true,
                        'options' => [
                            ['label' => 'Search Engine', 'value' => 'search'],
                            ['label' => 'Social Media', 'value' => 'social'],
                            ['label' => 'Friend/Family', 'value' => 'referral'],
                            ['label' => 'Travel Publication', 'value' => 'publication'],
                            ['label' => 'Other', 'value' => 'other']
                        ]
                    ]
                ]
            ])
        ]);
    }
}
