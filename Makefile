CREATEMODELNAME ?= $(shell bash -c 'read -p "Model Name: " modelname; echo $$modelname')
SEEDERTABLENAME ?= $(shell bash -c 'read -p "Seeder Name: " tablename; echo $$tablename')
FACTORYNAME ?= $(shell bash -c 'read -p "Factory Name: " factoryname; echo $$factoryname')
FACTORYMODELNAME ?= $(shell bash -c 'read -p "Model Name: " modelname; echo $$modelname')
PIVOTTABLEONE ?= $(shell bash -c 'read -p "Model One Name: " modelonename; echo $$modelonename')
PIVOTTABLETWO ?= $(shell bash -c 'read -p "Model Two Name: " modeltwoname; echo $$modeltwoname')
CONTROLLERNAME ?= $(shell bash -c 'read -p "Model Name: " modelname; echo $$modelname')
 

model:
	./vendor/bin/sail artisan make:model $(CREATEMODELNAME) -m


up:
	./vendor/bin/sail up

seeder:
	./vendor/bin/sail artisan make:seeder $(SEEDERTABLENAME)

factory:
	./vendor/bin/sail artisan make:factory $(FACTORYNAME) -m $(FACTORYMODELNAME)

migrate:
	./vendor/bin/sail artisan migrate

rollback-prev:
	./vendor/bin/sail artisan migrate:rollback

reset:
	./vendor/bin/sail artisan migrate:reset

seed:
	./vendor/bin/sail artisan migrate:fresh --seed

pivot:
	./vendor/bin/sail artisan make:migration create_$(PIVOTTABLEONE)_$(PIVOTTABLETWO)_table

controller:
	./vendor/bin/sail artisan make:controller ${CONTROLLERNAME}Controller --resource