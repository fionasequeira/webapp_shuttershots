# shuttershots - an image gallery
A simple PHP web application that allow visitors and signed up users alike, to browse a gallery of images uploaded across the network. Users signed up on shuttershots can upload a PNG, JPG, or GIF image with a caption. Visitors to the site can view uploaded images. A simple, secure login and signup system with PHP and PostgreSQL.

![Alt text](/assets/images/Login.png?raw=true "Landing")

## Getting Started

#### Installations
bitnami-mappstack-7.0.23-0-osx-x86_64-installer.dmg

#### Dependancies

- Apache - 2.4.18
- PHP 5.6.31
- PostgreSQL - 9.6
- Bitnami MAPP Stack 7.0.23-0
- phpPgAdmin 5.1

## Procedure

Download the mappstack image and Application at the Document Root 
$ cd <enter path to your Document Root>

Run the MAPP image file installed
Set Apache Web Server Port - 8888
Set SSL Port - 8445
Set Databse Server Port - 5434

Set PostgreSQL credentials
username- postgres
password- test

Open the Bitnami Application -> Manage Servers, the following servers must be running.
PostgreSQL Database
Apache Web Server

#### Cloning the Repository to this location-

$ cd /Users/Fiona/Desktop/WebApp/Application/apache2/htdocs/
$ git clone https://github.com/fionasequeira/webapp_shuttershots.git

#### Setting up phppgadmin and tables

- Open a browser and enter - http://localhost:8888/phppgadmin/

- Create db - postgres with the above PostgreSQL credentials and port

- Run the followin queries to set up the tables - 
```sql
CREATE TABLE public.userinfo
(
    user_id serial,
    creation_timestamp timestamp without time zone,
    email_id character varying(100) COLLATE pg_catalog."default" NOT NULL,
    username character varying(40) COLLATE pg_catalog."default" NOT NULL,
    user_password character varying(30) COLLATE pg_catalog."default" NOT NULL,
    first_name character(255) COLLATE pg_catalog."default" NOT NULL,
    last_name character(255) COLLATE pg_catalog."default" NOT NULL,
    date_of_birth date NOT NULL,
    picture_medium character varying(200),
    last_log_in timestamp without time zone,
    CONSTRAINT userinfo_pkey PRIMARY KEY (user_id)
);

CREATE TABLE public.multimedia
(
    media_id serial,
    post_time timestamp without time zone,
    content character varying(200) NOT NULL,
    description text COLLATE pg_catalog."default",
    user_id integer,
    CONSTRAINT multimedia_pkey PRIMARY KEY (media_id),
    CONSTRAINT multimedia_user_id_fkey FOREIGN KEY (user_id)
        REFERENCES public.userinfo (user_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
);
```
## Log-in and Home page walkthrough

#### Signup/Login Workflow:

Open a browser and enter - http://localhost:8888/webapp_shuttershots/app

This would redirect you to the login.php page.
- Browse the gallery as a visitor
- Existing users can sign in
- Sign up option for a visitor.
![Alt text](/assets/images/New%20user%20Sign%20up.png?raw=true "Landing")

#### Gallery

- Visitors are redirected to browsehome.php, wherein they can browse the livefeed, through all images across the shuttershots network.

 ![Alt text](/assets/images/Guest%20user%20Homepage.png?raw=true "Landing")

- Users are redirected to home.php, wherein they can browse the livefeed, through all images across the shuttershots network (including theirs) and have an option to Edit the caption or delete an image uploaded by them.

 ![Alt text](/assets/images/Existing%20user%20Homepage.png?raw=true "Landing")
 
- In additon, signed in users observe a nav bar with buttons, to view their profile, view all their photos, a settings button to edit their profile and a log out button to end the session.
 ![Alt text](/assets/images/Existing%20user's%20photo gallery.png?raw=true "Landing")
 ![Alt text](/assets/images/Option%20to%20edit%20caption:delete%20user's%20uploaded%20image%20in%20livefeed.png?raw=true "Landing")

The livefeed displays top 10 images sorted in descending order of date posted. 
All users view a previous / back button at the end of the livefeed, which redirects them to the previous 10 or next 10 images respectively, with notifications for end of gallery.

No new updates 
 ![Alt text](/assets/images/No%20new%20updates%20(Previous:Next).png?raw=true "Landing")
 
Previous and Next buttons on LIVEFEED
 ![Alt text](/assets/images/Previous%20and%20Next%20buttons%20on%20livefeed.png?raw=true "Landing")
 
End of gallery (previous:next)
 ![Alt text](/assets/images/End%20of%20gallery%20(previous:next).png?raw=true "Landing")
 
#### Upload Workflow:

- Login using login.php form.
- User is presented with all the images that were uploaded on the network at home.php.
- User observes a ready, set, shutter! button to upload new photos
- Goto upload_photos.php
- Provide an image caption and a valid image, hit Submit.

#### Delete/Update Caption Workflow:

There are two ways a user can achieve this.

##### Method 1
- Login using login.php form.
- User is presented with all the images that were uploaded on the network at home.php.
- User observes an Edit Caption/Delete button to photos uploaded by them.
- Goto edit_caption.php / remove_photo.php on the specified button being hit
- In the event of Edit Caption, provide an image caption, hit Submit.
- In the event of Delete, page redirects to notify the user than image has been Deleted.

![Alt text](/assets/images/Option%20to%20edit%20caption:delete%20user's%20uploaded%20image%20in%20livefeed.png?raw=true "Landing")

##### Method 2
- Login using login.php form.
- User is presented with all the images that were uploaded on the network at home.php.
- User observes an Edit Caption/Delete button to photos uploaded by them.
- Goto edit_caption.php / remove_photo.php on the specified button being hit
- In the event of Edit Caption, provide an image caption, hit Submit.
- In the event of Delete, page redirects to notify the user than image has been Deleted.

Edit Caption
![Alt text](/assets/images/Edit%20Caption.png?raw=true "Landing")

Delete Image confirmation.png
![Alt text](/assets/images/Delete%20Image%20confirmation.png?raw=true "Landing")
