Hotel reservation and billing system

Hello, marami akong concerns about this features as well as yung initial website na binigay sakin. 

Clarifications lang, take your time sa pagsagot kasi medyo marami to.

1. "Log in for admin"
For this page and other additional pages, do I need to apply designs / styles rin ba like for login and dashboard?
or Do I stick to "Backend Only" and let you guys style it yourselves, bale gawan ko na lang ng maayos na layout like yung picture below?

2. "Realtime booking (mag a-appear sa calendar pag fully booked na yung specific date and room)"
Goods lang to, this is the event calendar component.

3. "Makikita kung sino nakasched today, nag resched(with resched date), and future reservations
Kailangan makita what time nag check in and nag check out"
Using calendar lang rin to, so okay naman.

Pero confused ako sa core business process ng app na to, so I hope you enlighten me by answering my questions or if mali pagkakaintindi ko.

First of all, the hotel has 5 available rooms in total which can be occupied per day.
Pero sa provided html files ng site niyo, etong form lang yung about sa reservation/booking which is built wrong,
Kasi kapag nagbook si user dapat makita niya aling dates 'yung available pa at unavailable na as well as what rooms 'yung occupied or not.

A single day/night on the calendar can have 3 diff status.
1: Available = 5 rooms are available
2: Partially-Booked = Some rooms are booked and other rooms are still available
3: Fully-Booked = 5 rooms are booked

Dito ulit papasok yung event calendar, para makita at maselect lang ni user yung available dates lang.

Di kasi siya pwede mag select basta basta ng check-in date at check-out date kasi baka may naka occupy na sa slot na yun which can result into overlapping.
Baka dapat baguhin tong section na to.

Tapos sa ibang mga pages pala like yung sa rooms, may mga "Book now" button, which makes wonder kung anong purpose non, and I assume na upon clicking that button it will redirect the user on the actual reservation form?

4: "Confirmation email ng reservation and pag paid na
So sa reservation form, kunin ko narin name, email, contact number (pasabi if may additional pa),
Medyo vague lang to, pero eto ba yung after successful payment, magkakaron siya ng receipt sa email.
Like parang magiging proof ni user na siya yung nagpareserve at nagbayad tas dapat niyang ipakita yon on the day of checkin?

Kasi iniisip ko, kapag reservation, pwede sila magbook pero hindi magiging valid yung reservation ni user unless bayaran. So hindi masesecure or makakain yung slot sa calendar unless bayad na.

5: "Pag mag ccheck out na, iccheck out ni admin with the remaining balance"
Kasama ba online payment sa features na gagawin ko or is this actual payment nalang upon arrival ng user?
Pero sa #4 kasi, yung email receipt upon payment sa reservation requires payment na agad before proceeding eh so I guess may online payment?

6: "Makikita kung sino nakasched today, nag resched(with resched date), and future reservations"

About naman sa resched. Sa pagkakaintindi ko kasi si admin lang yung account, tas walang account si user.
So how can the user resched yung booking niya ?
Does the user need to call / email yung admin and let admin have the powers to change the booking? (which is manual, and dapat active si admin lalo na kapag biglaan yung resched)
or Does the user have to do it online? if online, pano niya ipoprove na siya yung nagbook at nagbayad, and saang interface niya gagawin yung pagselect ng new dates ?

If you can narrate yung buong business process from start to finish, mas lilinaw siguro, kasi maraming butas yung main business process.
May naisip kami ni angelo na process for this, which we can propose, pero I want to know first if ano yung original plan or idea niyo.

