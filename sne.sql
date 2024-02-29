-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: db.mysql.main:3306
-- Час створення: Лют 29 2024 р., 18:51
-- Версія сервера: 8.0.32
-- Версія PHP: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `sne`
--

-- --------------------------------------------------------

--
-- Структура таблиці `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(2, '123bohdan', '123bohdan@gmail.com', '$2y$12$3wqoIGerIptx8hzd0vhdlO6U9PnOx9NqUFxx/5Zr9uJwclF6OeRBC', '2024-02-29 18:15:16', '2024-02-29 18:15:16');

-- --------------------------------------------------------

--
-- Структура таблиці `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `categories`
--

INSERT INTO `categories` (`id`, `name`, `post_count`, `created_at`, `updated_at`) VALUES
(1, 'News', 9, '2024-02-29 18:16:13', '2024-02-29 18:25:27'),
(2, 'Works', 0, '2024-02-29 18:16:16', '2024-02-29 18:34:34'),
(3, 'Projects', 1, '2024-02-29 18:16:20', '2024-02-29 18:34:25'),
(4, 'Operations', 0, '2024-02-29 18:16:26', '2024-02-29 18:16:26'),
(5, 'Liblaries', 0, '2024-02-29 18:16:35', '2024-02-29 18:16:35'),
(6, 'Repositories', 0, '2024-02-29 18:16:54', '2024-02-29 18:16:54');

-- --------------------------------------------------------

--
-- Структура таблиці `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `comment_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `comments`
--

INSERT INTO `comments` (`id`, `comment_text`, `author_id`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 'Amazing, thank you!', 2, 1, '2024-02-29 18:31:35', '2024-02-29 18:31:35');

-- --------------------------------------------------------

--
-- Структура таблиці `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(13, '2019_08_19_000000_create_failed_jobs_table', 1),
(14, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(15, '2024_02_06_182341_create_categories_table', 1),
(16, '2024_02_06_182555_create_posts_table', 1),
(17, '2024_02_13_165200_create_comments_table', 1),
(18, '2024_02_13_181129_create_report_posts_table', 1),
(19, '2024_02_13_181134_create_report_comments_table', 1),
(20, '2024_02_22_190508_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `views_count` bigint NOT NULL DEFAULT '0',
  `likes_count` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `posts`
--

INSERT INTO `posts` (`id`, `title`, `text`, `author_id`, `category_id`, `views_count`, `likes_count`, `created_at`, `updated_at`) VALUES
(1, 'Intoduction Vector databases', '<h2>Introduction</h2>\n<p>Vector databases have gained prominence with the widespread adoption of large language models such as ChatGPT. However, their emergence predates this phenomenon, as they address a challenging issue that traditional databases struggle with: enabling similarity and semantic search functionality across diverse data types such as images, videos, and texts.</p>\n<p>Throughout this concise series, we will delve into the reasons why vector databases transcend mere hype and are indispensable in specific scenarios. We will explore the algorithms they employ, the challenges they confront, and apply theoretical principles to a practical application: constructing a recommendation system using this technology.</p>\n<p>Given the relatively nascent nature of the topic, authoritative textbooks on vector databases are limited. However, one notable resource, specialized in vector databases for NLP applications, serves as a commendable introduction to the subject.</p>\n<p><a href=\"https://amzn.to/42wvqTr\" target=\"_blank\" rel=\"noopener\">Vector Databases for Natural Language Processing: Building Intelligent NLP Applications with High-Dimensional Text Representations (Allen)</a></p>\n<p>This article was originally posted here: <a href=\"https://www.elementsofcomputerscience.com/posts/understanding-vector-databases-01/?utm_source=codeproject&amp;utm_medium=referral&amp;utm_campaign=understanding-vector-databases\">Understanding vector databases</a></p>\n<h2 id=\"in-the-beginning-was-data\">In the Beginning Was Data</h2>\n<p>Until recently, data was predominantly stored in traditional relational databases, and queries of varying complexity were executed to retrieve information.</p>\n<p><img class=\"lazyautosizes ls-is-cached lazyloaded\" style=\"width: 700px; height: auto; cursor: pointer; border: 0;\" src=\"https://www.codeproject.com/KB/Articles/5377237/9afadc6d-3298-49c8-a49e-e5049d03c29d-r-700.Png\"></p>', 4, 1, 33, 0, '2024-02-29 18:20:10', '2024-02-29 18:35:09'),
(2, 'Neural networks', '<h2>Introduction</h2>\n<p>Neural networks are a computational model inspired by the way biological neural networks in the human brain function that consist of interconnected nodes, or artificial neurons, organized in layers. Information is processed through these layers, with each connection having an associated weight that is adjusted during the learning process. Neural networks are commonly used in machine learning to recognize patterns, make predictions, and perform various tasks based on data inputs.</p>\n<p>We will delve into the details of this definition in subsequent posts, demonstrating how neural networks can outperform other methods. Specifically, we will begin with logistic regression and illustrate, through a straightforward example, how it may fall short and how deep learning, on the contrary, can be advantageous. As usual, we adopt a step-by-step approach to progressively address the challenges associated with this data structure.</p>\n<p>We consulted the following books as references to compose this series.</p>\n<ul>\n<li><a href=\"https://amzn.to/3SdzYL4\" target=\"_blank\" rel=\"noopener\">Deep Learning (Goodfellow, Bengio, Courville)</a></li>\n<li><a href=\"https://amzn.to/47xp3Aj\" target=\"_blank\" rel=\"noopener\">Deep Learning: Foundations and Concepts (Bishop, Bishop)</a></li>\n</ul>\n<p>This series was originally posted <a href=\"https://www.elementsofcomputerscience.com/posts/implementing-neural-networks-csharp-01/?utm_source=codeproject&amp;utm_medium=referral&amp;utm_campaign=implementing-neural-networks\">here</a>.</p>', 4, 1, 6, 0, '2024-02-29 18:23:02', '2024-02-29 18:26:14'),
(3, 'Machine learning', '<h2>Introduction</h2>\n<p>Neural networks are a computational model inspired by the way biological neural networks in the human brain function that consist of interconnected nodes, or artificial neurons, organized in layers. Information is processed through these layers, with each connection having an associated weight that is adjusted during the learning process. Neural networks are commonly used in machine learning to recognize patterns, make predictions, and perform various tasks based on data inputs.</p>\n<p>We will delve into the details of this definition in subsequent posts, demonstrating how neural networks can outperform other methods. Specifically, we will begin with logistic regression and illustrate, through a straightforward example, how it may fall short and how deep learning, on the contrary, can be advantageous. As usual, we adopt a step-by-step approach to progressively address the challenges associated with this data structure.</p>\n<p>We consulted the following books as references to compose this series.</p>\n<ul>\n<li><a href=\"https://amzn.to/3SdzYL4\" target=\"_blank\" rel=\"noopener\">Deep Learning (Goodfellow, Bengio, Courville)</a></li>\n<li><a href=\"https://amzn.to/47xp3Aj\" target=\"_blank\" rel=\"noopener\">Deep Learning: Foundations and Concepts (Bishop, Bishop)</a></li>\n</ul>\n<p>This series was originally posted <a href=\"https://www.elementsofcomputerscience.com/posts/implementing-neural-networks-csharp-01/?utm_source=codeproject&amp;utm_medium=referral&amp;utm_campaign=implementing-neural-networks\">here</a>.</p>', 4, 1, 1, 0, '2024-02-29 18:23:50', '2024-02-29 18:26:11'),
(4, 'Intoduction ChatGPT', '<h2>Introduction</h2>\n<p>Neural networks are a computational model inspired by the way biological neural networks in the human brain function that consist of interconnected nodes, or artificial neurons, organized in layers. Information is processed through these layers, with each connection having an associated weight that is adjusted during the learning process. Neural networks are commonly used in machine learning to recognize patterns, make predictions, and perform various tasks based on data inputs.</p>\n<p>We will delve into the details of this definition in subsequent posts, demonstrating how neural networks can outperform other methods. Specifically, we will begin with logistic regression and illustrate, through a straightforward example, how it may fall short and how deep learning, on the contrary, can be advantageous. As usual, we adopt a step-by-step approach to progressively address the challenges associated with this data structure.</p>\n<p>We consulted the following books as references to compose this series.</p>\n<ul>\n<li><a href=\"https://amzn.to/3SdzYL4\" target=\"_blank\" rel=\"noopener\">Deep Learning (Goodfellow, Bengio, Courville)</a></li>\n<li><a href=\"https://amzn.to/47xp3Aj\" target=\"_blank\" rel=\"noopener\">Deep Learning: Foundations and Concepts (Bishop, Bishop)</a></li>\n</ul>\n<p>This series was originally posted <a href=\"https://www.elementsofcomputerscience.com/posts/implementing-neural-networks-csharp-01/?utm_source=codeproject&amp;utm_medium=referral&amp;utm_campaign=implementing-neural-networks\">here</a>.</p>', 4, 1, 0, 0, '2024-02-29 18:24:03', '2024-02-29 18:24:03'),
(5, 'How to make real AI on C#', '<h2>Introductio</h2>\n<p>Neural networks are a computational model inspired by the way biological neural networks in the human brain function that consist of interconnected nodes, or artificial neurons, organized in layers. Information is processed through these layers, with each connection having an associated weight that is adjusted during the learning process. Neural networks are commonly used in machine learning to recognize patterns, make predictions, and perform various tasks based on data inputs.</p>\n<p>We will delve into the details of this definition in subsequent posts, demonstrating how neural networks can outperform other methods. Specifically, we will begin with logistic regression and illustrate, through a straightforward example, how it may fall short and how deep learning, on the contrary, can be advantageous. As usual, we adopt a step-by-step approach to progressively address the challenges associated with this data structure.</p>\n<p>We consulted the following books as references to compose this series.</p>\n<ul>\n<li><a href=\"https://amzn.to/3SdzYL4\" target=\"_blank\" rel=\"noopener\">Deep Learning (Goodfellow, Bengio, Courville)</a></li>\n<li><a href=\"https://amzn.to/47xp3Aj\" target=\"_blank\" rel=\"noopener\">Deep Learning: Foundations and Concepts (Bishop, Bishop)</a></li>\n</ul>\n<p>This series was originally posted <a href=\"https://www.elementsofcomputerscience.com/posts/implementing-neural-networks-csharp-01/?utm_source=codeproject&amp;utm_medium=referral&amp;utm_campaign=implementing-neural-networks\">here</a>.</p>', 4, 1, 0, 0, '2024-02-29 18:24:23', '2024-02-29 18:24:23'),
(6, 'Questions for junior PHP', '<h2>Introductio</h2>\n<p>Neural networks are a computational model inspired by the way biological neural networks in the human brain function that consist of interconnected nodes, or artificial neurons, organized in layers. Information is processed through these layers, with each connection having an associated weight that is adjusted during the learning process. Neural networks are commonly used in machine learning to recognize patterns, make predictions, and perform various tasks based on data inputs.</p>\n<p>We will delve into the details of this definition in subsequent posts, demonstrating how neural networks can outperform other methods. Specifically, we will begin with logistic regression and illustrate, through a straightforward example, how it may fall short and how deep learning, on the contrary, can be advantageous. As usual, we adopt a step-by-step approach to progressively address the challenges associated with this data structure.</p>\n<p>We consulted the following books as references to compose this series.</p>\n<ul>\n<li><a href=\"https://amzn.to/3SdzYL4\" target=\"_blank\" rel=\"noopener\">Deep Learning (Goodfellow, Bengio, Courville)</a></li>\n<li><a href=\"https://amzn.to/47xp3Aj\" target=\"_blank\" rel=\"noopener\">Deep Learning: Foundations and Concepts (Bishop, Bishop)</a></li>\n</ul>\n<p>This series was originally posted <a href=\"https://www.elementsofcomputerscience.com/posts/implementing-neural-networks-csharp-01/?utm_source=codeproject&amp;utm_medium=referral&amp;utm_campaign=implementing-neural-networks\">here</a>.</p>', 4, 1, 1, 0, '2024-02-29 18:24:37', '2024-02-29 18:25:33'),
(7, 'Duplicating Shazam fingerprints', '<h2>Introductio</h2>\n<p>Neural networks are a computational model inspired by the way biological neural networks in the human brain function that consist of interconnected nodes, or artificial neurons, organized in layers. Information is processed through these layers, with each connection having an associated weight that is adjusted during the learning process. Neural networks are commonly used in machine learning to recognize patterns, make predictions, and perform various tasks based on data inputs.</p>\n<p>We will delve into the details of this definition in subsequent posts, demonstrating how neural networks can outperform other methods. Specifically, we will begin with logistic regression and illustrate, through a straightforward example, how it may fall short and how deep learning, on the contrary, can be advantageous. As usual, we adopt a step-by-step approach to progressively address the challenges associated with this data structure.</p>\n<p>We consulted the following books as references to compose this series.</p>\n<ul>\n<li><a href=\"https://amzn.to/3SdzYL4\" target=\"_blank\" rel=\"noopener\">Deep Learning (Goodfellow, Bengio, Courville)</a></li>\n<li><a href=\"https://amzn.to/47xp3Aj\" target=\"_blank\" rel=\"noopener\">Deep Learning: Foundations and Concepts (Bishop, Bishop)</a></li>\n</ul>\n<p>This series was originally posted <a href=\"https://www.elementsofcomputerscience.com/posts/implementing-neural-networks-csharp-01/?utm_source=codeproject&amp;utm_medium=referral&amp;utm_campaign=implementing-neural-networks\">here</a>.</p>', 4, 1, 0, 0, '2024-02-29 18:24:52', '2024-02-29 18:24:52'),
(8, 'Intoduction to Java Spring', '<h2>Introductio</h2>\n<p>Neural networks are a computational model inspired by the way biological neural networks in the human brain function that consist of interconnected nodes, or artificial neurons, organized in layers. Information is processed through these layers, with each connection having an associated weight that is adjusted during the learning process. Neural networks are commonly used in machine learning to recognize patterns, make predictions, and perform various tasks based on data inputs.</p>\n<p>We will delve into the details of this definition in subsequent posts, demonstrating how neural networks can outperform other methods. Specifically, we will begin with logistic regression and illustrate, through a straightforward example, how it may fall short and how deep learning, on the contrary, can be advantageous. As usual, we adopt a step-by-step approach to progressively address the challenges associated with this data structure.</p>\n<p>We consulted the following books as references to compose this series.</p>\n<ul>\n<li><a href=\"https://amzn.to/3SdzYL4\" target=\"_blank\" rel=\"noopener\">Deep Learning (Goodfellow, Bengio, Courville)</a></li>\n<li><a href=\"https://amzn.to/47xp3Aj\" target=\"_blank\" rel=\"noopener\">Deep Learning: Foundations and Concepts (Bishop, Bishop)</a></li>\n</ul>\n<p>This series was originally posted <a href=\"https://www.elementsofcomputerscience.com/posts/implementing-neural-networks-csharp-01/?utm_source=codeproject&amp;utm_medium=referral&amp;utm_campaign=implementing-neural-networks\">here</a>.</p>', 4, 1, 0, 0, '2024-02-29 18:25:05', '2024-02-29 18:25:05'),
(9, 'Learning Bootstrap 5.0', '<h2>Introductio</h2>\n<p>Neural networks are a computational model inspired by the way biological neural networks in the human brain function that consist of interconnected nodes, or artificial neurons, organized in layers. Information is processed through these layers, with each connection having an associated weight that is adjusted during the learning process. Neural networks are commonly used in machine learning to recognize patterns, make predictions, and perform various tasks based on data inputs.</p>\n<p>We will delve into the details of this definition in subsequent posts, demonstrating how neural networks can outperform other methods. Specifically, we will begin with logistic regression and illustrate, through a straightforward example, how it may fall short and how deep learning, on the contrary, can be advantageous. As usual, we adopt a step-by-step approach to progressively address the challenges associated with this data structure.</p>\n<p>We consulted the following books as references to compose this series.</p>\n<ul>\n<li><a href=\"https://amzn.to/3SdzYL4\" target=\"_blank\" rel=\"noopener\">Deep Learning (Goodfellow, Bengio, Courville)</a></li>\n<li><a href=\"https://amzn.to/47xp3Aj\" target=\"_blank\" rel=\"noopener\">Deep Learning: Foundations and Concepts (Bishop, Bishop)</a></li>\n</ul>\n<p>This series was originally posted <a href=\"https://www.elementsofcomputerscience.com/posts/implementing-neural-networks-csharp-01/?utm_source=codeproject&amp;utm_medium=referral&amp;utm_campaign=implementing-neural-networks\">here</a>.</p>', 4, 1, 0, 0, '2024-02-29 18:25:27', '2024-02-29 18:25:27'),
(11, 'Super Shoes!', '<h2>Implementation Example <a id=\"inpage-nav-3\"></a></h2>\n<p>This example uses a simple website describing the Super Shoes! Store as a base (<strong>Figure 1</strong>). A retailer could use their own website or generate a document containing important information about the company. The following example shows how to develop a simple chatbot that can answer questions, therefore decreasing response time from the customer&rsquo;s perspective.</p>\n<p><img src=\"https://www.codeproject.com/KB/Articles/5372209/f1-part-of-the-website-used-in-our-example.png\" alt=\"\" width=\"749\" height=\"553\"></p>', 2, 3, 0, 0, '2024-02-29 18:34:25', '2024-02-29 18:34:25');

-- --------------------------------------------------------

--
-- Структура таблиці `report_comments`
--

CREATE TABLE `report_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `comment_id` bigint UNSIGNED NOT NULL,
  `who_report_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `report_posts`
--

CREATE TABLE `report_posts` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `who_report_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `report_posts`
--

INSERT INTO `report_posts` (`id`, `post_id`, `who_report_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2024-02-29 18:32:18', '2024-02-29 18:32:18');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmation_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_banned` tinyint(1) NOT NULL DEFAULT '0',
  `is_banned_posts` tinyint(1) NOT NULL DEFAULT '0',
  `is_banned_comments` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified`, `password`, `confirmation_token`, `avatar_url`, `is_banned`, `is_banned_posts`, `is_banned_comments`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alexandr', 'alexandr@gmail.com', 0, '$2y$12$ur91sHXqMI0Q4IY.0f7..e6.7YaPQ6LjXGWpZbv9Pvasb1pFU9zCS', 'b745032e-3c61-42fc-8743-5045192489ff', 'http://localhost/storage/avatars/1/original.webp', 0, 0, 0, NULL, '2024-02-29 18:13:26', '2024-02-29 18:13:28'),
(2, 'Petya', 'petyapuptuk@gmail.com', 0, '$2y$12$4AwIQHVIx2Zursjd3mBVfuzUgnkxD4VB.25hKiLmNiRIr54H5SgMe', '46c541a6-88a5-4a17-a79d-5885f528f9fb', 'http://localhost/storage/avatars/2/original.webp', 0, 0, 0, NULL, '2024-02-29 18:13:29', '2024-02-29 18:13:31'),
(3, 'Vasya', 'vasyapupkin@gmail.com', 0, '$2y$12$D25ZfTHJJuSbZajo9EkV3uXI2VdBvyIVukByJ.vlUQ/5igVniWg9O', 'b7e2ea48-db02-4c0b-b009-36c47ea60c48', 'http://localhost/storage/avatars/3/original.webp', 0, 0, 0, NULL, '2024-02-29 18:13:32', '2024-02-29 18:13:35'),
(4, 'Recounts', 'bogdankapriyanua@gmail.com', 0, '$2y$12$l55hI7ux1csE0vkvrvGXN.yMJEwgOyMdzAKdmoUY3Hxh.wFxEIBOe', 'f6e94e5f-8467-4e42-b5d5-2deda9e3ad67', 'http://localhost/storage/avatars/4/original.webp', 0, 0, 0, NULL, '2024-02-29 18:13:35', '2024-02-29 18:13:38');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_author_id_foreign` (`author_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Індекси таблиці `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Індекси таблиці `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Індекси таблиці `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Індекси таблиці `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_author_id_foreign` (`author_id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Індекси таблиці `report_comments`
--
ALTER TABLE `report_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_comments_comment_id_foreign` (`comment_id`),
  ADD KEY `report_comments_who_report_id_foreign` (`who_report_id`);

--
-- Індекси таблиці `report_posts`
--
ALTER TABLE `report_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_posts_post_id_foreign` (`post_id`),
  ADD KEY `report_posts_who_report_id_foreign` (`who_report_id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблиці `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблиці `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблиці `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблиці `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблиці `report_comments`
--
ALTER TABLE `report_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `report_posts`
--
ALTER TABLE `report_posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `report_comments`
--
ALTER TABLE `report_comments`
  ADD CONSTRAINT `report_comments_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `report_comments_who_report_id_foreign` FOREIGN KEY (`who_report_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `report_posts`
--
ALTER TABLE `report_posts`
  ADD CONSTRAINT `report_posts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `report_posts_who_report_id_foreign` FOREIGN KEY (`who_report_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
