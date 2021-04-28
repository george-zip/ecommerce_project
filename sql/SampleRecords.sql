delete from Items where 1 = 1;
delete from Product where 1 = 1;
delete from CustomerOrder where 1 = 1;
delete from Customer where 1 = 1;
delete from Employee where 1 = 1;
delete from User where 1 = 1;
delete from Role where 1 = 1;

insert into Role values (1, "Owner");
insert into Role values (2, "Employee");
insert into Role values (3, "Administrator");
insert into Role values (4, "Customer");
select * from Role;

insert into User values (1, 1, "Phil", "Carson", "14148 Sunset Boulevard", "Hollywood", "CA", "90028", "encrypted");
insert into User values (2, 2, "John", "Acocella", "1201 Laurel Way", "Beverly Hills", "CA", "90210", "encrypted");
insert into User values (3, 3, "Zach", "Dau", "200 Delfern Drive", "Beverly Hills", "CA", "90210", "encrypted");
insert into User values (4, 4, "Chris", "Wallerstein", "31100 Broad Beach Road", "Beverly Hills", "CA", "90210", "encrypted");
select * from User;

insert into Employee values (2, "123456789", "2017-04-15", 60000);
select * from Employee;

insert into Customer values (4, "2018-10-20", "By credit card");
select * from Customer;

insert into CustomerOrder values (1, 4, "2020-02-20");
select * from CustomerOrder;

insert into Product values (1,
                            "Drum Kit",
                            "Gretsch Drums Renown RN2-R643 3-piece",
                            "http://www.vintageludwigdrums.com/images/shop/66_clubdate_blackoysterpearl.jpg",
                            1,
                            1429.00);

insert into Product values (2,
                            "Instructional DVD",
                            "Ultimate Beginner Series - Drum Basics",
                            "https://images-na.ssl-images-amazon.com/images/I/51v1PdbyKvL.jpg",
                            15,
                            22.99);

insert into Product values (3,
                            "Drumsticks",
                            "Vic Firth American Classic Drumsticks 6-pack",
                            "https://images-na.ssl-images-amazon.com/images/I/41lN7LFnzPL._AC_.jpg",
                            40,
                            9.99);

insert into Product values (4,
                            "Cymbals",
                            "Sabian SBR 10 inch Splash Cymbal",
                            "https://images-na.ssl-images-amazon.com/images/I/71aH-ovzuBL._AC_SL1400_.jpg",
                            5,
                            28.99);

select * from Product;

insert into Items values (1, 3, 4);
insert into Items values (1, 2, 1);
select * from Items;