# (*another*) PHP MVC Framework
Includes autoloader and routing.

## Server Setup
Tested on PHP7 and Apache2
1. `sudo a2enmod rewrite`
2. Configure `apache2.conf`
Needs AllowOverrride All for htaccess rewrite
```conf
<Directory /path/to/webroot/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
        Allow from localhost
</Directory>
```

## Use
1. Request URIs follow this pattern `/controller/method/param1/paramN`
   1. Configuration  
      1. Add new routes in `/config/Routes.php `
      2. Add new namespaces in `/config/Namespaces.php`
2. Interfaces
   1. List of Intefaces in Core (src/)
      1. Controller - instantiates Service and View
      2. Service - instantiates mappers, business logic classes, and entities (returns)
      3. Mapper - uses DBHelper for repository queries
      4. Entity - Getters/Setters store for View
      5. View - uses entities and renders views/templates
3. Exceptions
   1. Update /public/index.php with new exception classes to catch them
   2. Uncaught excpetions go to Exception|Error handled and logged with error code
4. Tests
   1. Only test classes under app directory
   2. Unit - where no other resource (class, filesystem, database, etc) is needed for the method being tested
   3. Integration - where other resources are included in the test
   4. Functional - client tests (eg rendered page, api response, etc)


## Data Flow

```bash
#           ##
#         ##  ##
#       ##      ##
#     ##  Client  ## <-------------------------------------------+
#       ##      ##                                               |
#         ##  ##                                                 |
#           ##                                                   |
#            |                                                   |
#            v                                                   |
#   ##################         ##################         ################
#   #                #         #                #         #              #
#   #   index.php    # ------> #   controller   #-------> #     View     #
#   #                #         #                #         #              #
#   ##################         ##################         ################
#                                 |         ^                    ^
#                                 |         |                    |
#                                 v         |                    v
#                              ##################         +--------------+
#                              #                #         |              |
#                              #   Service      #         |   Templates  |
#                              #                #         |              |
#                              ##################         +--------------+
#                                      ^
#                 +--------------------+--------------------+
#                 v                    v                    v
#   ##################         ##################         ################
#   #                #         #                #         #              #
#   #   Mapper       #         #   BL Classes   #         #     Entity   #
#   #                #         #                #         #              #
#   ##################         ##################         ################
#          ^
#          |
#          v
#      ##########
#      #        #
#      #        #
#      #   DB   #
#      #        #
#      #        #
#      ##########
#
```

## References
1. Inspirations from: https://github.com/andrejrs/php-mvc-example
