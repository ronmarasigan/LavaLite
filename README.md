# 🔥 LavaLite Framework

**LavaLite** is a lightweight PHP framework designed for developers who want
**speed, simplicity, and control** — without the bloat.

Built from scratch, LavaLite provides a **built-in SQL Query Builder** and a
**clean routing system**, making it perfect for APIs, small to medium web apps,
and custom projects.

---

## ✨ Features

- 🚀 **Built-in SQL Query Builder**
- 🧭 **Simple & Flexible Routing**
- 🪶 **Lightweight Core**
- 🛠 **Developer-Friendly Structure**
- ⚡ **Fast Performance**

---

## 📦 Requirements

- PHP **8.0+**
- MySQL / MariaDB / PostgreSQL
- Apache or Nginx
- Composer *(optional)*

---

## 🧭 Routing Example

```php
$router->get('/users', 'users.php');

$router->get('/users/{id}', 'users.php');

$router->post('/send', 'send.php');
Clean URLs. No magic.

🗄 SQL Query Builder Example
$user = db()->table('users')
           ->select('id, name, email')
           ->where('id', 1)
Fluent, readable, and secure — no raw SQL required.
```

---

## 🤝 Contributing
Contributions are welcome!

Fork the repository

Create your feature branch

Commit your changes

Open a pull request

## 📜 License
LavaLite is open-source software licensed under the MIT License.

## ❤️ Credits
Built with passion using PHP
Inspired by modern frameworks — simplified.

# 🔥 LavaLite — Keep it light. Build it fast.