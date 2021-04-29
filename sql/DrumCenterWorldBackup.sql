drop database if exists DrumCenterWorld;
create database if not exists DrumCenterWorld;

use DrumCenterWorld;

create table Role
(
    RoleID          int unsigned auto_increment not null,
    RoleDescription varchar(50)                 not null,
    primary key (RoleID)
);

create table User
(
    UserID            int unsigned auto_increment not null,
    RoleID            int unsigned                not null,
    FirstName         varchar(30)                 not null,
    LastName          varchar(30)                 not null,
    Street            varchar(50)                 not null,
    City              varchar(30)                 not null,
    StateAbbreviation char(2)                     not null,
    ZipCode           char(9)                     not null,
    Password          char(60)                    not null,
    primary key (UserID),
    foreign key (RoleID) references Role (RoleID) on delete restrict
);

create table Employee
(
    EmployeeID int unsigned not null,
    SSN        char(9)      not null,
    HireDate   date         not null,
    Salary     float(8, 2)  not null,
    foreign key (EmployeeID) references User (UserID) on delete restrict,
    check (Salary > 0.0),
    check (HireDate > '2015-01-01')
);

create table Customer
(
    CustomerID    int unsigned not null,
    JoinDate      date         not null,
    BillingMethod varchar(50)  not null,
    foreign key (CustomerID) references User (UserID) on delete restrict,
    check (JoinDate > '2015-01-01')
);

create table CustomerOrder
(
    OrderID    int unsigned auto_increment not null,
    CustomerID int unsigned                not null,
    LastUpdate datetime                    not null,
    primary key (OrderID),
    foreign key (CustomerID) references Customer (CustomerID),
    check (LastUpdate > '2015-01-01')
);

create table Product
(
    ProductID    int unsigned auto_increment not null,
    Category     varchar(30)                 not null,
    Description  varchar(80)                 not null,
    PhotoLink    varchar(120)                not null,
    AvailableQty smallint unsigned           not null,
    Price        float(6, 2)                 not null,
    primary key (ProductID),
    check (AvailableQty >= 0),
    check (Price > 0.0)
);

create table Items
(
    OrderID   int unsigned not null,
    ProductID int unsigned not null,
    OrderQty  float(6, 2)  not null,
    foreign key (OrderID) references CustomerOrder (OrderID) on delete restrict,
    foreign key (ProductID) references Product (ProductID) on delete restrict,
    check (OrderQty > 0.0)
);