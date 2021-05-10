# Responsibilities

Just to give an idea of the sorta stuff I have to do throughout the year

## Content

Changing up the content on the site is one of the easier tasks because it mostly involves changing text and HTML/CSS.

A large number of changes will be on the landing page, `index.html`. As more information comes out (like dates, committees, prices, etc.), most of it will end up on the landing page. 

*Note: there are a lot of commented-out blocks in `index.html`, most of which are pre-made parts that I hide and show depending on what content needs to be displayed (e.g.: there's a section on applications that gets un-commented when applications open).*

Some of the stuff you may be expected to change directly on the website content-wise:

* Content on landing page
* Links that appear on the navbar (`navbar.php`)
* Team member photos and positions (`teams.html`)
* Promotional/informational pages (such as `prague.html` and `partners-en.html`)
* Banners and alerts across the website (such as on landing page or `apply.php`)
* Uploading media and creating new pages depending on what the conference needs

---

## Changing accessibility

While it usually doesn't take long, opening/closing applications is pretty important. The process to open applications is twofold:

1. Announcing it on the landing page. Lines 144-199 on `index.html` are the sections for committees and delegate applications; lines 238-278 are for chair applications.
2. Allowing link access on `apply.php` – when users login, they are given links to applications for different positions. When closed, the buttons are disabled and are enabled when applications for the respective positions open. Notes on how to do this on line 180 of `apply.php`

---

## Database work

You'll find yourself doing a fair bit of stuff in the database, primarily through the PHPMyAdmin interface. The database has two main functions:

### Providing content for the front end

To ease transitions between editions and better facilitate changes, committees and their respective countries are handled by the database. 

The `committees` table holds the data for committees shown on `committees.php` and on the application forms. This includes display names, chair ids and committee topics/descriptions.

Moreover, each committee has its own table, each storing the countries with representation. Each row has a primary id, the country's ISO 3166 alpha-2 code, two versions of the full name (e.g.: *"The Republic of Korea"* and *"Korea, Republic of"*, with the latter making it easier to alphabetise) and the userid of the delegate representing the country (`0` if not yet assigned).

With creating the committee tables, I honestly forgot how I did them but it involved some Excel stuff to get all the names and then using that to create a bunch of SQL queries, for example to create the table for the WHO:

```sql
CREATE TABLE `who` (
  `countryid` int(11) NOT NULL,
  `countrycode` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `displayname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `displayname2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```

And then to populate the table with the countries:

```sql
INSERT INTO `who` (`countryid`, `countrycode`, `displayname`, `displayname2`, `userid`) VALUES
(1, 'BD', 'The People\'s Republic of Bangladesh', 'Bangladesh, People\'s Republic of', 0),
(2, 'BR', 'The Federative Republic of Brazil', 'Brazil, Federative Republic of', 0),
(3, 'BF', 'The Republic of Burkina Faso', 'Burkina Faso, Republic of', 0),
(4, 'CN', 'The People\'s Republic of China', 'China, People\'s Republic of', 0),
(5, 'FI', 'The Republic of Finland', 'Finland, Republic of', 0),
(6, 'IL', 'The State of Israel', 'Israel, State of', 0),
(7, 'JP', 'Japan', 'Japan', 0),
(8, 'KE', 'The Republic of Kenya', 'Kenya, Republic of', 0),
(9, 'RO', 'Romania', 'Romania', 0),
(10, 'SG', 'The Republic of Singapore', 'Singapore, Republic of', 0),
(11, 'TZ', 'The United Republic of Tanzania', 'Tanzania, United Republic of', 0),
(12, 'AE', 'The United Arab Emirates', 'United Arab Emirates', 0),
(13, 'US', 'The United States of America', 'United States of America', 0),
(14, 'ZM', 'The Republic of Zambia', 'Zambia, Republic of', 0);
```

### Managing users 

Ah the lifeblood of the PLISMUN registration system. Here, there's one main table with three more subsidiary tables:

`users`: each user account is stored here along with a userid (primary key), personal information and the position they hold (left empty if they don't have a position assigned to them)

`delegates`: when a user applies for a delegate position, an entry is made in this table with a foreign key linking to the userid in `users`, details about their application (committee/country choices and motivation letters) along with empty attributes for their final assigned committee and country (or if they get rejected by the applications team)

`chairs`: when a user applies for a chairing position, their application is stored in a new row in this table, similarly with a foreign key linking to the user. Because chair applications are reviewed through email, the position and committee attributes must be set manually once a decision has been made (or not at all – there's some redundancy here as the userids of the chairs are also stored in the `committees` table)

`delegations`: delegation leaders can register a delegation under which delegates apply under. The delegation is accompanied with a foreign key to the userid of the person who created it and a counter exists tallying the number of delegates who've applied under the delegation.

**Some basics points on maintenance:**

* With each new conference, just the `delegates`, `chairs` and `delegations` tables are emptied
* With each new conference, the 'position' attribute of each user is the `users` table is set to empty

## Emails

PLISMUN21 switched to using the plismun.com domain for emails as opposed to gmail.com in previous editions. You can set them up in the `Emails > Email Accounts` section of the Hostinger dashboard.

The hosting comes with a default webmail (mail.hostinger.com) but it's also possible to use another client like the MacOS Mail app. Navigating to `Preferences > Accounts` in Mail allows you to add a custom email address. It'll require the address, password as well as the incoming/outgoing mail server (you can find the IMAP and SMTP servers on the web hosting dashboard).

Creating emails is done through the dashboard as well. Once you do, the password has to be sent to whoever needs to access it.

The website also has mailing scripts to send emails from these addresses. The following pages use this functionality:

* `applychair.php`
* `contact.php`
* `delegateapplications.php`
* `forgotpassword.php`
* `managedelegation.php`

Be careful when changing passwords as the emails on the website will break if they are not updated.