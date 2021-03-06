use DrumCenterWorld;

delete from Items where 1 = 1;
delete from Product where 1 = 1;
delete from CustomerOrder where 1 = 1;
delete from Customer where 1 = 1;
delete from Employee where 1 = 1;
delete from Users where 1 = 1;
delete from Role where 1 = 1;

insert into Role values (4, "Owner");
insert into Role values (3, "Employee");
insert into Role values (2, "Administrator");
insert into Role values (1, "Customer");
select * from Role;

# unencrypted version of password is 'test' (without quote marks)
insert into Users values (1, 4, "Phil", "Carson", "phil.carson@hotmail.com", "14148 Sunset Boulevard", "Hollywood", "CA", "90028", "$2y$10$p9V.MBZIPGewwxTkE7RcEeU0vImGe78UU1k5MLuWDZR3pVX1bYpU2");
insert into Users values (2, 2, "John", "Acocella", "john_a@gmail.com", "1201 Laurel Way", "Beverly Hills", "CA", "90210", "$2y$10$p9V.MBZIPGewwxTkE7RcEeU0vImGe78UU1k5MLuWDZR3pVX1bYpU2");
insert into Users values (3, 3, "Zach", "Dau", "zachd@foo.com", "200 Delfern Drive", "Beverly Hills", "CA", "90210", "$2y$10$p9V.MBZIPGewwxTkE7RcEeU0vImGe78UU1k5MLuWDZR3pVX1bYpU2");
insert into Users values (4, 1, "Chris", "Wallerstein", "wallersteinc1@montclair.edu", "31100 Broad Beach Road", "Beverly Hills", "CA", "90210", "$2y$10$p9V.MBZIPGewwxTkE7RcEeU0vImGe78UU1k5MLuWDZR3pVX1bYpU2");
select * from Users;

insert into Employee values (3, "123456789", "2017-04-15", 60000);
select * from Employee;

insert into Customer values (4, "2018-10-20", "By credit card");
select * from Customer;

insert into CustomerOrder values (1, 4, "2020-02-20");
select * from CustomerOrder;

insert into Product values (1,
                            "1",
                            "Gretsch Drums Renown RN2-R643 3-piece",
                            "drum_kit.jpeg",
                            1,
                            1429.00);

insert into Product values (2,
                            "2",
                            "Ultimate Beginner Series - Drum Basics",
                            "dvd.jpeg",
                            15,
                            22.99);

insert into Product values (3,
                            "3",
                            "Vic Firth American Classic Drumsticks 6-pack",
                            "drum_sticks.jpeg",
                            40,
                            9.99);

insert into Product values (4,
                            "4",
                            "Sabian SBR 10 inch Splash Cymbal",
                            "cymbal.jpeg",
                            5,
                            28.99);

insert into Product values (5,
                            "1",
                            "More drums",
                            "drum_kit.jpeg",
                            1,
                            529.00);


select * from Product;

insert into Items values (1, 3, 4);
insert into Items values (1, 2, 1);
select * from Items;