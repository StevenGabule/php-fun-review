CREATE DATABASE my_guitar_shop;
CREATE DATABASE IF NOT EXISTS my_guitar_shop;
USE my_guitar_shop;
DROP DATABASE my_guitar_shop;
DROP DATABASE IF EXISTS my_guitar_shop;

The syntax of the create index statement
SYNTAX:
create [unique] index|key indexName
on tableName (cn1 [asc|desc], [, cn2 [asc]desc]]...)

create index customerId
on orders (customerID);

create unique index emailAddress
on customers (emailAddress);

create unique index customerIdOrderNumber
on orders (customerId, orderNumber);

create table customers (
    // column declaration...
    PRIMARY KEY(customerId),
    unique index emailAddress (emailAddress),
    INDEX firstName (firstName)
);

drop index firstName on customers;
