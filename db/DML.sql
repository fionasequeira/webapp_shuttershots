--userinfo-
insert into userinfo values(1,current_timestamp,'andrea@mail.com','AndreaJovi123','Password!','Andrea','Jovi',5168,'Female','09/12/1987',NULL,current_timestamp,current_timestamp,NULL,NULL,1,3);
insert into user info values(2,current_timestamp,'brenda@mail.com','BCraig','Password!','Brenda','Craig',51764,'Female' ,'03/29/1997',NULL,current_timestamp,current_timestamp,NULL,NULL,1,1);
insert into userinfo values(3,current_timestamp,'daniel@mail.com','danielcharles007','Password!','Charles','Daniel','51681','Male','01/05/1990',NULL,current_timestamp,current_timestamp,NULL,NULL,1,1);
insert into userinfo values(4,current_timestamp,'darwin@mail.com', 'darwin_johanson','Password!','Darwin','Johanson','43200','Male','11/02/1982',NULL,current_timestamp,current_timestamp,NULL,NULL,1,3);
insert into userinfo values(5,current_timestamp,'elle@mail.com', 'ellejohn___01','Password!','Elle','John','63143','Female','09/01/1991',NULL,current_timestamp,current_timestamp,NULL,NULL,1,2);
insert into userinfo values(6,current_timestamp,'fay@mail.com', 'FaySn0w001','Password!','Fay','Snow','9221','Female','04/20/1984',NULL,current_timestamp,current_timestamp,NULL,NULL,1,1);
insert into userinfo values(7,current_timestamp,'watson@mail.com', 'Watsonsden777','Password!','Brian','Watson','41600','Male','01/12/1991',NULL,current_timestamp,current_timestamp,NULL,NULL,1,1);
insert into userinfo values(8,current_timestamp,'hilton@mail.com','hiltonscarlett','Password!','Hilton','Scarlett','93698','Male','11/12/1995',NULL,current_timestamp,current_timestamp,NULL,NULL,1,1);
insert into userinfo values(9,current_timestamp,'ina@mail.com', 'InaWoody09','Password!','Ina','Wood','4090','Female','01/09/1989',NULL,current_timestamp,current_timestamp,NULL,NULL,1,3);
insert into userinfo values(10,current_timestamp,'jack@mail.com', 'JAckWillIAMS123','Password!','Jack','Williams','4091','Male','02/01/1982',NULL,current_timestamp,current_timestamp,NULL,NULL,1,2);
insert into userinfo values(11,current_timestamp,'karl@mail.com', 'KarlRobbinHood','Password!','Karl','Robbin','54791','Female','09/12/1987',NULL,current_timestamp,current_timestamp,NULL,NULL,1,2);
insert into userinfo values(12,current_timestamp,'lennon@mail.com', 'LennonRay12345678','Password!','Lennon','Ray','90891','Male','10/21/1990',NULL,current_timestamp,current_timestamp,NULL,NULL,1,2);
insert into userinfo values(13,current_timestamp,'maxx@mail.com', 'Maxx','Password!','Max','Blunt','98982','Female','08/01/1993',NULL,current_timestamp,current_timestamp,NULL,NULL,1,3);


--friendrelation-
insert into friendrelation values (1,2,2,0,1,current_timestamp);
insert into friendrelation values (3,2,2,0,3,current_timestamp);
insert into friendrelation values (8,2,2,0,8,current_timestamp);
insert into friendrelation values (1,3,2,0,3,current_timestamp);
insert into friendrelation values (1,8,2,0,1,current_timestamp);
insert into friendrelation values (4,8,2,0,4,current_timestamp);
insert into friendrelation values (4,9,2,0,9,current_timestamp);
insert into friendrelation values (3,9,2,0,3,current_timestamp);
insert into friendrelation values (7,3,1,0,1,current_timestamp);
insert into friendrelation values (11,2,2,0,3,current_timestamp);
insert into friendrelation values (1,11,1,0,11,current_timestamp);
insert into friendrelation values (1,5,2,0,5,current_timestamp);
insert into friendrelation values (6,4,2,0,6,current_timestamp);


--multimedia-
insert into multimedia values(1,current_timestamp,NULL,'text',1);
insert into multimedia values(2,current_timestamp,NULL,'text',1);
insert into multimedia values(3,current_timestamp,NULL,'text',7);
insert into multimedia values(4,current_timestamp,NULL,'text',9);
insert into multimedia values(5,current_timestamp,NULL,'text',2);
insert into multimedia values(6,current_timestamp,NULL,'text',1);
insert into multimedia values(7,current_timestamp,NULL,'text',4);
insert into multimedia values(8,current_timestamp,NULL,'text',1);
insert into multimedia values(9,current_timestamp,NULL,'text',3);
insert into multimedia values(10,current_timestamp,NULL,'text',1);
insert into multimedia values(11,current_timestamp,NULL,'text',6);
insert into multimedia values(12,current_timestamp,NULL,'text',1);
insert into multimedia values(13,current_timestamp,NULL,'text',8);
insert into multimedia values(14,current_timestamp,NULL,'text',9);
insert into multimedia values(15,current_timestamp,NULL,'text',1);
insert into multimedia values(16,current_timestamp,NULL,'text',1);
insert into multimedia values(17,current_timestamp,NULL,'text',13);
insert into multimedia values(18,current_timestamp,NULL,'text',12);
insert into multimedia values(19,current_timestamp,NULL,'text',3);
insert into multimedia values(20,current_timestamp,NULL,'text',6);
insert into multimedia values(21,current_timestamp,NULL,'text',5);
insert into multimedia values(22,current_timestamp,NULL,'text',2);
insert into multimedia values(23,current_timestamp,NULL,'text',4);
insert into multimedia values(24,current_timestamp,NULL,'text',10);

--diaryentry-
insert into diaryentry values('Description',2,1,current_timestamp,'title',2,15);
insert into diaryentry values('Description',3,1,current_timestamp,'title',3,16);
insert into diaryentry values('Description',4,1,current_timestamp,'title',1,8);
insert into diaryentry values('Description',5,1,current_timestamp,'title',1,10);
insert into diaryentry values('Description',6,9,current_timestamp,'title',1,14);
insert into diaryentry values('Description',7,2,current_timestamp,'title',2,22);
insert into diaryentry values('Description',8,13,current_timestamp,'title',3,17);
insert into diaryentry values('Description',9,6,current_timestamp,'title',3,20);
insert into diaryentry values('Description',10,6,current_timestamp,'title',2,11);

--diary_comments-
insert into diary_comments values(1,'comment1',1,current_timestamp,1);
insert into diary_comments values(2,'comment2',2,current_timestamp,4);
insert into diary_comments values(3,'comment3',3,current_timestamp,3);
insert into diary_comments values(4,'comment4',4,current_timestamp,6);
insert into diary_comments values(5,'comment5',4,current_timestamp,7);
insert into diary_comments values(6,'comment6',4,current_timestamp,8);
insert into diary_comments values(7,'comment7',4,current_timestamp,9);
insert into diary_comments values(8,'comment8',7,current_timestamp,11);
insert into diary_comments values(9,'comment9',9,current_timestamp,12);
insert into diary_comments values(10,'comment10',10,current_timestamp,12);
insert into diary_comments values(11,'comment11',10,current_timestamp,4);
insert into diary_comments values(12,'comment12',3,current_timestamp,6);


--diary_likes-
insert into diary_likes values(1,3,current_timestamp);
insert into diary_likes values(2,1,current_timestamp);
insert into diary_likes values(3,2,current_timestamp);
insert into diary_likes values(4,1,current_timestamp);
insert into diary_likes values(5,2,current_timestamp);
insert into diary_likes values(6,8,current_timestamp);
insert into diary_likes values(7,4,current_timestamp);
insert into diary_likes values(8,7,current_timestamp);
insert into diary_likes values(6,4,current_timestamp);
insert into diary_likes values(1,1,current_timestamp);
insert into diary_likes values(3,3,current_timestamp);
insert into diary_likes values(5,11,current_timestamp);
insert into diary_likes values(5,5,current_timestamp);
insert into diary_likes values(6,6,current_timestamp);
insert into diary_likes values(3,5,current_timestamp);
insert into diary_likes values(9,7,current_timestamp);
insert into diary_likes values(9,9,current_timestamp);
insert into diary_likes values(10,10,current_timestamp);
insert into diary_likes values(6,3,current_timestamp);


--location-
insert into location values (1,null,null,'central park','new york city','ny','usa');
insert into location values (2,null,null,'breakneck ridge','cold springs','ny','usa');
insert into location values (3,null,null,null,'montauk','ny','usa');

--events-
insert into events values (1,"Location: Breakneck Ridge\n\nEvent Info: This trek is not for the light-hearted.\nExperienced trekkers ONLY.",current_timestamp,2,NULL,"Hiking at Breakneck Ridge");
insert into events values (2,"Location: Central Park\n\nEvent Info: Please bring your own mat and a water bottle.\nWe accomodate all levels of experience.",current_timestamp,1,NULL,"Meditation in Central Park");

--event_members-
insert into event_members values(1,2);
insert into event_members values(1,5);
insert into event_members values(1,6);
insert into event_members values(1,7);
insert into event_members values(1,2);
insert into event_members values(2,13);
insert into event_members values(2,10);
insert into event_members values(2,6);
insert into event_members values(2,7);
insert into event_members values(1,4);
insert into event_members values(1,8);
insert into event_members values(1,9);
insert into event_members values(2,10);
insert into event_members values(2,2);
insert into event_members values(1,3);
insert into event_members values(2,3);
insert into event_members values(2,2);

--posts
insert into posts values(1,2,'POSTS',current_timestamp,1);
insert into posts values(1,3,'POSTS',current_timestamp,2);
insert into posts values(1,5,'POSTS',current_timestamp,3);
insert into posts values(1,6,'POSTS',current_timestamp,4);
insert into posts values(1,7,'POSTS',current_timestamp,5);
insert into posts values(1,9,'POSTS',current_timestamp,6);
insert into posts values(2,2,'POSTS',current_timestamp,7);
insert into posts values(6,2,'POSTS',current_timestamp,8);
insert into posts values(3,2,'POSTS',current_timestamp,9);
insert into posts values(6,2,'POSTS',current_timestamp,10);
insert into posts values(7,2,'POSTS',current_timestamp,11);
insert into posts values(9,2,'POSTS',current_timestamp,12);
insert into posts values(4,2,'POSTS',current_timestamp,13);
