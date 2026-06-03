<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::truncate();

        $posts = [
            [
                'title' => 'Port Moody\'s Mossom Creek Hatchery to Host Free Wildlife Safety 101 Workshop',
                'body' => "PORT MOODY, B.C. — Local residents and outdoor enthusiasts will have the opportunity to learn crucial wildlife safety skills at a free workshop hosted by the Mossom Creek Hatchery & Education Centre on Friday, June 19.\n\nThe \"Wildlife Safety 101\" session, running from 6:30 p.m. to 7:45 p.m., will be led by Joseph Daniels, a Public Outreach and Education Officer with Parks Canada. The interactive workshop is designed to equip attendees with practical, real-world skills for safely navigating unexpected wildlife encounters.\n\nDuring the hour-and-a-fifteen-minute session, participants will learn how to better understand animal behavior and take proactive steps to reduce human-wildlife conflict. A key component of the workshop will also focus on the effective and responsible use of bear spray in emergency situations.\n\nAs urban areas in the Tri-Cities continue to interface closely with natural habitats, wildlife encounters are a familiar reality for many residents. Organizers hope this educational initiative will foster safer outdoor recreation and promote coexistence with local wildlife.\n\nThe event will be held on-site at the Mossom Creek Hatchery & Education Centre, located at 12 Mossom Creek Drive in Port Moody.\n\nWhile the workshop is completely free to attend, space is limited and advance registration is required. Interested individuals are encouraged to secure their tickets promptly via Eventbrite.",
                'event_at' => null,
            ],
            [
                'title' => 'Ammy Virk to Perform at Pacific Coliseum on August 1',
                'body' => "Vancouver is set to host acclaimed Punjabi singer and actor Ammy Virk, who will perform live at the Pacific Coliseum on August 1, 2026. The concert is scheduled to begin at 8:00 PM, with doors opening an hour earlier at 7:00 PM. Virk, known for his blockbuster songs and captivating stage presence, is expected to deliver a memorable performance.\n\nThe event, described as 'not just a concert—it's a celebration of Punjabi music, culture, and pure entertainment,' will take place at the Pacific Coliseum, located at 100 N Renfrew St, Vancouver, BC V5K 4W3. Attendees can purchase tickets online or by calling 604-252-3700.\n\nAmmy Virk has garnered widespread recognition for his significant contributions to the Punjabi music and film industries, continuously captivating audiences globally with his passion and authenticity.",
                'event_at' => null,
            ],
            [
                'title' => 'Grammy-Winning Artist Keyon Harrold to Perform at Vancouver International Jazz Festival',
                'body' => "Grammy Award-winning trumpeter, vocalist, and producer Keyon Harrold will be a featured artist at the Vancouver International Jazz Festival, with a performance scheduled for Tuesday, June 30, 2026. The concert, titled \"Keyon Harrold: Foreverland and Songs for Miles,\" will take place at the Vancouver Playhouse, with doors opening at 6:30 p.m. and the show beginning at 7:30 p.m.\n\nHailed by Wynton Marsalis as \"the future of the trumpet,\" Harrold's performance will showcase material from his Grammy-nominated album Foreverland. This project is recognized for its crossover collaborations with artists such as Common, Robert Glasper, PJ Morton, and Laura Mvula, blending elements of jazz, hip-hop, and spoken word to create a dynamic sonic experience.\n\nThe evening will also feature \"Songs for Miles,\" a dedicated tribute to the influential jazz icon Miles Davis. Harrold gained international recognition for his role as the trumpet voice for Miles Davis in Don Cheadle's 2015 biopic, Miles Ahead. His extensive career includes collaborations with global music figures like Beyoncé, Rihanna, Jeff Beck, and Keith Richards.\n\nThe Vancouver Civic Theatres, in partnership with the Vancouver International Jazz Festival and Coastal Jazz, is organizing the event. Harrold is noted for his emotionally-charged compositions that seamlessly traverse genres from rock to hip-hop to classical piano, all anchored by his distinctive jazz-rooted melodic motifs. The New York Times has described him as \"a scorching trumpeter.\"",
                'event_at' => null,
            ],
            [
                'title' => 'POMO Museum Announces \'Movie Night on the Train\' for July 2026',
                'body' => "The POMO Museum in Port Moody is set to bring back its 'Movie Night on the Train' event, scheduled for Saturday, July 18, 2026. The event is scheduled to take place at the museum, located at 2734 Murray Street, from 5:30 p.m. to 7:45 p.m.\n\nWhile the date and time have been confirmed, specific details regarding the movie selection, ticketing information, and other event specifics are yet to be announced by the Port Moody Heritage Society-operated museum. Officials encourage interested residents to check back soon for more information.",
                'event_at' => null,
            ],
            [
                'title' => 'The Como Lake Fishing Derby Returns!',
                'body' => "The Como Lake Fishing Derby returns on May 31 from 8:00 am to 12:00 pm.\n\nSponsored by the Port Coquitlam & District Hunting & Fishing Club, Sea-Run Fly & Tackle, and the Kinsmen Club of Coquitlam, the Como Lake Fishing Derby brings families from the Tri-Cities and beyond to the shores of Como Lake to bond over a pancake breakfast, connect with their local community while waiting for fish to bite, and even win some prizes for their catches.\n\nFor some, attending the derby has become an annual tradition. Regular attendees may park themselves in their go-to spot and cast their rods until they get the bite they desire.\n\nChildren will basically line the banks of the lake and fish, generally with bobber and worm, catch a fish, and the fish is weighed. Awards are given to the attendees who catch the largest or smallest fish, among other prizes. Some of the prizes up for grabs include fishing rods, trophies, and grab bags.\n\nA couple of days before the event, the Freshwater Fisheries Society of BC re-stocks the lake with around 1,500 new fish to make sure that everyone gets a fair shot at getting a bite on their hook.\n\nGo Fish BC will be providing rods for children to loan during the derby. Children at the age of 16 will need to acquire a fishing license to take part.",
                'event_at' => null,
            ],
            [
                'title' => 'Poirier Sport and Leisure Complex Announces Annual Maintenance Closure',
                'body' => "The Poirier Sport and Leisure Complex in Coquitlam is set to undergo its annual scheduled maintenance, necessitating a temporary closure from Tuesday, June 2, through June 28. The facility is expected to resume full operations on June 29.\n\nDuring this period, the complex's fitness centre and weight room will have a shorter closure, from June 2 to June 8, reopening on Tuesday, June 9. While the main facility is closed, the reception desk and café will maintain reduced operating hours.\n\nCity officials, including Community Recreation Manager Michael Fox, emphasize that \"this annual maintenance is crucial for the longevity of the facility, mitigating equipment breakdowns, and ensuring a safe environment\" for staff and the public.\n\nResidents seeking alternative aquatic options can utilize the indoor swimming facilities at the City Centre Aquatic Complex, located at 1210 Pinetree Way. Additionally, Coquitlam's outdoor pools at Mundy Park and Eagle Ridge are scheduled to open for the season on May 30.",
                'event_at' => null,
            ],
            [
                'title' => 'Port Coquitlam Announces City-Wide Garage Sale on June 13',
                'body' => "Port Coquitlam is gearing up for its annual City-Wide Garage Sale, scheduled for Friday, June 13, 2026. This popular community event encourages residents to host their own garage sales from 9 a.m. to 1 p.m., promoting reuse, recycling, and neighborly connection.\n\nTo participate as a seller, residents must register their addresses by June 7, 2026. This registration ensures their inclusion on an official event map and searchable list. The initiative aims to help participants dispose of unwanted items in an environmentally friendly manner, as bargain hunters explore sales across the community.\n\nThe city offers several tips for hosts, including putting up signs, preparing with small change, and pricing items in advance. Hosts are also encouraged to invite neighbors to participate simultaneously to attract more shoppers. Important safety reminders include keeping money secure, confining pets, and not inviting strangers into homes.\n\nUnsold items are not collected by the city; instead, residents are encouraged to donate them to local charities such as Eagle Ridge Hospital Auxiliary Thrift Shop, Crossroads Hospice Society, or the Salvation Army Thrift Store.",
                'event_at' => null,
            ],
            [
                'title' => 'Vancouver Symphony Orchestra to Bring \'Star Wars: Return of the Jedi\' to the Big Screen with Live Score',
                'body' => "VANCOUVER, B.C. — The Force is set to awaken at the Orpheum Theatre this summer as the Vancouver Symphony Orchestra (VSO) announces its upcoming presentation of Star Wars: Return of the Jedi in Concert. Audiences will have the opportunity to experience the climactic sixth episode of the legendary sci-fi saga on the big screen, accompanied by a live, full-orchestra performance of John Williams's iconic musical score.\n\nThe special concert event is scheduled for two evening performances on Thursday, July 16, and Friday, July 17, 2026, with both shows beginning at 7:00 p.m.\n\nLed by conductor Julian Pellicano, the VSO will perform the film's sweeping soundtrack live-to-picture. The performance offers a unique, immersive way to experience the 1983 classic, in which Luke Skywalker, Princess Leia, and Han Solo reunite to face Darth Vader and launch a desperate, galaxy-saving attack against the Imperial Fleet and the second Death Star.\n\nThe production is a featured installment of the \"Movie Nights with the VSO\" series, presented by TELUS. The performance will run for approximately two hours and 95 minutes, including one intermission.\n\nTickets for both the July 16 and July 17 performances are currently available for purchase through the Vancouver Symphony Orchestra's official website and the VSO box office.",
                'event_at' => null,
            ],

            // --- Edge case posts ---

            // EC-1: Multiple dates for the same event
            [
                'title' => 'Vancouver Craft Beer Week: Two Flagship Events in July',
                'body' => "Vancouver Craft Beer Week returns this summer with two flagship events at the Vancouver Convention Centre. The VIP Industry Tasting Night is set for Friday, July 10, 2026, while the Public Grand Tasting follows on Saturday, July 11, 2026. Both events begin at 6:00 PM and run until 10:00 PM. Tickets are available now at craftbeerweek.ca.",
                'event_at' => null,
            ],

            // EC-2: Doors time vs. show time
            [
                'title' => 'The National to Headline the Commodore Ballroom This August',
                'body' => "Indie rock veterans The National will take the stage at the Commodore Ballroom on Saturday, August 15, 2026. Doors open at 7:30 PM with the support act beginning at 8:00 PM, followed by The National's headline set at 9:00 PM. Tickets are $65 and available through Ticketmaster.",
                'event_at' => null,
            ],

            // EC-3: Date range (closure, not a single event)
            [
                'title' => 'Burnaby Mountain Golf Course Closes for Annual Turf Maintenance',
                'body' => "The Burnaby Mountain Golf Course will be temporarily closed for scheduled turf maintenance and irrigation upgrades from Monday, July 6 through Sunday, July 19, 2026. The course is expected to resume normal operations on Monday, July 20. Golfers are encouraged to explore the Riverway Golf Course as an alternative during this period.",
                'event_at' => null,
            ],

            // EC-4: Event date already in the past
            [
                'title' => 'Port Moody Rotary Club Spring Gala Recap',
                'body' => "The Port Moody Rotary Club held its annual Spring Gala on Saturday, May 9, 2026, at 6:00 PM at the Inlet Theatre. The sold-out evening featured a three-course dinner, a silent auction, and live performances. Proceeds from the event will fund local youth literacy programs. The club thanks all attendees and sponsors for their generous support.",
                'event_at' => null,
            ],

            // EC-5: Date with no time
            [
                'title' => 'Coquitlam Farmers Market Opening Day Announced for June 20',
                'body' => "The Coquitlam Farmers Market is set to open for the 2026 season on Saturday, June 20, 2026. The weekly market will take place in the Pinetree Community Centre parking lot at 1260 Pinetree Way. Shoppers can expect fresh local produce, artisan baked goods, handcrafted items, and live music. No specific opening time has been announced; organizers will share full operating hours closer to the date.",
                'event_at' => null,
            ],

            // EC-6: Registration deadline easily mistaken for event date
            [
                'title' => 'Burnaby 5K Fun Run — Registration Closes June 20, Race on July 5',
                'body' => "Runners of all ages are invited to take part in the Burnaby 5K Fun Run, scheduled for Sunday, July 5, 2026, at 8:00 AM at Central Park. Early registration is encouraged, as sign-ups close on Saturday, June 20, 2026. Participants who register before June 10 will receive a commemorative race shirt. The course winds through Central Park's scenic trails and is suitable for all fitness levels.",
                'event_at' => null,
            ],

            // EC-7: Ambiguous year (no year stated)
            [
                'title' => 'Deep Cove Canoe Regatta Returns This August 22',
                'body' => "The beloved Deep Cove Canoe Regatta is returning this August 22 for another day of friendly competition on the waters of Indian Arm. Paddlers of all experience levels are welcome, with categories for solo canoes, tandem pairs, and youth participants. Registration opens at 8:30 AM at the Deep Cove Canoe & Kayak Centre, with races beginning at 10:00 AM.",
                'event_at' => null,
            ],

            // EC-8: Vague time of day (no clock time)
            [
                'title' => 'An Evening of Jazz at the Vancouver Cellar — August 7',
                'body' => "The Vancouver Cellar Jazz Club invites music lovers for a special evening performance on Friday, August 7, 2026. Local quartet the Ray Chen Group will take the stage for a late-night set featuring original compositions and jazz standards. This is an 18+ event. Doors open in the evening; dress code is smart casual. Reservations are recommended.",
                'event_at' => null,
            ],

            // EC-9: Time expressed as a range (start vs. end ambiguity)
            [
                'title' => "Surrey Children's Art Fair at Bear Creek Park — June 27",
                'body' => "Families are invited to the Surrey Children's Art Fair at Bear Creek Park on Saturday, June 27, 2026, running from 10:00 AM to 4:00 PM. The free community event will feature hands-on art stations, live demonstrations, and a young artists' showcase. Parking is free and strollers are welcome. The fair runs rain or shine.",
                'event_at' => null,
            ],

            // EC-10: Historical/reference dates mixed into the body
            [
                'title' => 'Vancouver Whitecaps FC to Host 52nd Anniversary Celebration Match',
                'body' => "The Vancouver Whitecaps FC, founded in 1974, will honour their storied history with a special 52nd Anniversary Celebration Match on Saturday, August 8, 2026, at 7:30 PM at BC Place. The club's legendary 1978 NASL Soccer Bowl victory will be commemorated with a halftime ceremony featuring members of the original squad. Fans from the 1974 founding era are encouraged to attend.",
                'event_at' => null,
            ],

            // EC-11: Relative date only (no absolute date)
            [
                'title' => 'Intimate Cooking Class with Chef Marcus Webb This Thursday',
                'body' => "Join celebrated local chef Marcus Webb this coming Thursday for an intimate cooking class at his Gastown studio. The three-hour evening session begins at 6:30 PM and will focus on Pacific Northwest cuisine using seasonal, locally sourced ingredients. Class size is limited to 12 participants. Guests should arrive a few minutes early as the session starts promptly.",
                'event_at' => null,
            ],

            // EC-12: Recurring event (no single date)
            [
                'title' => 'Port Coquitlam Sunday Farmers Market Now Open Weekly',
                'body' => "The Port Coquitlam Sunday Farmers Market is back for the 2026 season, running every Sunday morning from 8:00 AM to 11:00 AM at the Wilson Centre parking lot. Local vendors offer fresh produce, baked goods, preserves, plants, and handcrafted items each week. The market runs through the end of October. Bring your own bags and enjoy free parking.",
                'event_at' => null,
            ],

            // EC-13: Multiple separate events described in one post
            [
                'title' => 'Tri-Cities Music Festival Announces Dual-Stage Lineup',
                'body' => "The Tri-Cities Music Festival returns with a two-night lineup at Mundy Park. The Secondary Stage opens the festival on Friday, July 24, 2026 at 5:00 PM, featuring rising local acts and community performers. The Main Stage then hosts headliner Tegan and Sara on Saturday, July 25, 2026 at 8:00 PM. Day passes and weekend bundles are available at tricitiesmusicfest.ca.",
                'event_at' => null,
            ],

            // EC-14: Season or month reference only (no specific date)
            [
                'title' => 'Langley Community Theatre Announces Fall 2026 Production of A Midsummer Night\'s Dream',
                'body' => "The Langley Community Theatre is excited to announce that its upcoming fall production will be Shakespeare's A Midsummer Night's Dream. The show is planned for fall 2026, with auditions expected to begin in August. Specific performance dates, ticket pricing, and casting information will be shared once confirmed. Interested performers and volunteers can join the theatre's mailing list to stay informed.",
                'event_at' => null,
            ],

            // EC-15: Dates embedded in addresses and historical references
            [
                'title' => 'New Westminster Heritage Home Tour — September 12',
                'body' => "The New Westminster Heritage Home Tour takes place on Saturday, September 12 at 10:00 AM, departing from the Irving House at 302 Royal Avenue. Tour guides will lead groups through homes built as far back as 1893, including the landmark Carnegie Library completed in 1905. To register, call 604-527-4640 or visit the museum at 302 Royal Avenue. The two-hour tour wraps up by noon.",
                'event_at' => null,
            ],

            // EC-16: Multi-day event with a clear opening night
            [
                'title' => 'Vancouver International Film Festival 2026 Dates Announced',
                'body' => "The Vancouver International Film Festival (VIFF) has announced its 2026 edition will run from Thursday, September 24 through Sunday, October 4, 2026. Opening Night on September 24 begins at 7:30 PM with a red carpet premiere at the Vogue Theatre, followed by an industry reception. Over 300 films from 70 countries will screen across 10 days at venues throughout Vancouver.",
                'event_at' => null,
            ],

            // EC-17: No AM/PM specified
            [
                'title' => 'Sunrise Yoga Retreat at Cultus Lake — July 12',
                'body' => "A peaceful Sunrise Yoga and Meditation Retreat is coming to Cultus Lake on Sunday, July 12, 2026. The morning session begins at 6:00 and runs for two hours, guided by certified instructor Priya Sethi. Participants should arrive by 5:45 to get settled. Light refreshments and a post-practice breakfast are included. Spots are limited — register at cultuslakeliving.ca.",
                'event_at' => null,
            ],

            // EC-18: No date at all
            [
                'title' => 'City of Vancouver Announces Upcoming Outdoor Sculpture Exhibition at Vanier Park',
                'body' => "The City of Vancouver is thrilled to announce plans for an outdoor sculpture exhibition at Vanier Park, showcasing works from over 20 local and international artists. The exhibition will be free and open to the public. Specific dates, participating artists, and installation details are still being finalized. Residents are encouraged to sign up for the city's newsletter to receive updates as they become available.",
                'event_at' => null,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
