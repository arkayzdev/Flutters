create table USERS
(
    id_client          int auto_increment
        primary key,
    first_name         varchar(50)                                                                   null,
    last_name          varchar(50)                                                                   null,
    password           varchar(255)                                                                  null,
    email              varchar(100)                                                                  null,
    email_verification int          default 0                                                        null,
    avatar             varchar(255) default 'https://flutters.ovh/pages/profile/components/base.png' null,
    user_type          varchar(10)  default 'Normal'                                                 null,
    status             varchar(10)  default 'none'                                                   null,
    last_login         date                                                                          null,
    last_login_active  int          default 1                                                        null,
    constraint email
        unique (email)
);
create table EVENT
(
    id_event    int auto_increment
        primary key,
    name        varchar(100)   null,
    description text           not null,
    date_event  date           not null,
    capacity    int            null,
    price       decimal(19, 4) null,
    start_time  time           null,
    image       varchar(100)   null
);
create table DIRECTOR
(
    id_director int auto_increment
        primary key,
    last_name   varchar(50) null,
    first_name  varchar(50) null
);
create table ACTOR
(
    id_actor   int auto_increment
        primary key,
    first_name varchar(50) not null,
    last_name  varchar(50) not null
);
create table ROOM
(
    id_room       int         not null
        primary key,
    room_name     varchar(50) null,
    capacity_seat int         not null
);
create table COMPONENT
(
    id_component int auto_increment
        primary key,
    src          varchar(100)                             null,
    type         enum ('head', 'eyes', 'mouth', 'outfit') null,
    name         varchar(40)                              null
);
create table TYPE
(
    id_type int auto_increment
        primary key,
    name    varchar(50) not null
);
create table LANGUAGE
(
    id_language int auto_increment
        primary key,
    name        varchar(30) null
);
create table NEWSLETTER
(
    email    varchar(100) not null
        primary key,
    sub_date date         null
);
create table MOVIE
(
    id_movie     int auto_increment
        primary key,
    description  text         not null,
    title        varchar(50)  not null,
    release_date date         not null,
    duration     int          null,
    poster_image varchar(100) null,
    trailer      varchar(255) null,
    id_language int REFERENCES LANGUAGE(id_language)
);
create table IS_TO
(
    id_movie int not null,
    id_type  int not null,
    primary key (id_movie, id_type),
    constraint IS_TO_ibfk_1
        foreign key (id_movie) references MOVIE (id_movie),
    constraint IS_TO_ibfk_2
        foreign key (id_type) references TYPE (id_type)
);
create table REALIZED
(
    id_movie    int not null,
    id_director int not null,
    primary key (id_movie, id_director),
    constraint REALIZED_ibfk_1
        foreign key (id_movie) references MOVIE (id_movie),
    constraint REALIZED_ibfk_2
        foreign key (id_director) references DIRECTOR (id_director)
);
create table PLAYED
(
    id_movie int not null,
    id_actor int not null,
    primary key (id_movie, id_actor),
    constraint PLAYED_ibfk_1
        foreign key (id_movie) references MOVIE (id_movie),
    constraint PLAYED_ibfk_2
        foreign key (id_actor) references ACTOR (id_actor)
);
create table TAKE_PLACE
(
    id_session int not null,
    id_movie   int not null,
    primary key (id_session, id_movie),
    constraint TAKE_PLACE_ibfk_2
        foreign key (id_movie) references MOVIE (id_movie)
);
create table REVIEW
(
    id_review        int auto_increment
        primary key,
    description      text   null,
    score            double null,
    id_movie         int    not null,
    id_client        int    not null,
    publication_date date   null,
    constraint REVIEW_ibfk_1
        foreign key (id_movie) references MOVIE (id_movie),
    constraint REVIEW_ibfk_2
        foreign key (id_client) references USERS (id_client)
);
create table SESSION
(
    id_session  int auto_increment
        primary key,
    price       decimal(19, 4)                  not null,
    seance_date date                            not null,
    start_time  time                            not null,
    id_room     int                             not null,
    language    enum ('VO', 'VOSTFR', 'VOSTEN') null,
    constraint SESSION_ibfk_1
        foreign key (id_room) references ROOM (id_room)
);
create table WEARS
(
    id_client    int not null,
    id_component int not null,
    primary key (id_client, id_component),
    constraint WEARS_ibfk_1
        foreign key (id_client) references USERS (id_client),
    constraint WEARS_ibfk_2
        foreign key (id_component) references COMPONENT (id_component)
);
create table TICKET
(
    id_ticket  int auto_increment
        primary key,
    id_session int          null,
    id_event   int          null,
    order_id   varchar(255) not null,
    constraint TICKET_ibfk_2
        foreign key (id_event) references EVENT (id_event),
    constraint TICKET_ibfk_3
        foreign key (order_id) references ORDERS (order_id)
);
create table ORDERS
(
    order_id      varchar(255)  not null
        primary key,
    purchase_date date          not null,
    final_price   double        null,
    id_client     int           not null,
    validate      int default 0 null,
    constraint ORDERS_ibfk_1
        foreign key (id_client) references USERS (id_client)
);
create table PAYMENT
(
    id            varchar(255)   not null
        primary key,
    id_session    int            null,
    price         decimal(19, 4) null,
    name          varchar(55)    null,
    email         varchar(55)    null,
    account_email varchar(55)    null,
    id_event      int            null,
    constraint PAYMENT_ibfk_2
        foreign key (account_email) references USERS (email)
);