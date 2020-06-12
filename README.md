Tempo
==========

Licence: AGPL

Project : a web app to register time past on projects and tasks and analyze time spent,

Stack : 
Symfony 4.4
Bootstrap 4
PHP 7.4
MySQL 5.7

ROLES :
- ROLE_USER: record his own time, analytics of his own time
- ROLE_ADMIN: + manage files, tasks, analytics of all ROLE_USER and his own analytics 
- ROLE_SUPER_ADMIN : + manage roles of other users, analytics of all, manage firm account

ENTITIES :
- USER : well, it is a user (see roles upthere)
- COMPANY : a company is a group of users. A user user belong to only one company (for the moment). A company has only one super-admin (for the moment). A company has a "day perdiod" aka the length of a working day (use in analytics)
- PROJECT : name of a project
- TASK : can have multiple subtasks and one mother taks (subtasks and mother task are TASK)
- TIME : it is startdate and endate for a project and task and user





