1. Public
File yang bisa diakses oleh user
    1. folder css
    2. folder js
    3. folder image

2. Folder app
Menyimpan folder dan file utama dari aplikasi mvc
    1. folder core = route
    2. folder controllers = 
    3. folder views = 
    4. folder models =

    folder views
        1. 

3. index.php

pengecekan url
http://localhost/mvc/public/index.php?url=2121

di http://localhost/mvc/public/

```plaintext
project/
│
├── app/
│   ├── Controllers/
│   │   ├── Auth/
│   │   │   ├── LoginController.php
│   │   │   ├── RegisterController.php
│   │   │   └── LogoutController.php
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   └── UserController.php
│   │   └── Frontend/
│   │       ├── HomeController.php
│   │       └── ArticleController.php
│   │
│   ├── Models/
│   │   ├── Entities/
│   │   │   ├── User.php
│   │   │   └── Article.php
│   │   ├── Repositories/
│   │   │   ├── UserRepository.php
│   │   │   └── ArticleRepository.php
│   │   └── Database.php
│   │
│   ├── Views/
│   │   ├── layouts/
│   │   │   ├── header.php
│   │   │   └── footer.php
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   └── register.php
│   │   ├── admin/
│   │   │   ├── dashboard.php
│   │   │   └── users.php
│   │   └── frontend/
│   │       ├── home.php
│   │       └── article.php
│   │
│   └── Helpers/
│       ├── SessionHelper.php
│       └── FormHelper.php
│
├── config/
│   ├── database.php
│   ├── app.php
│   └── routes.php
│
├── public/
│   ├── css/
│   ├── js/
│   ├── images/
│   └── index.php
│
├── storage/
│   ├── cache/
│   ├── logs/
│   └── uploads/
│
├── vendor/                # composer packages
└── index.php              # Entry point

```

1 controller punya 1 folder sendiri
