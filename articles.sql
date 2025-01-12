-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : sql210.infinityfree.com
-- Généré le :  sam. 11 jan. 2025 à 20:36
-- Version du serveur :  10.6.19-MariaDB
-- Version de PHP :  7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `if0_38083266_main_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `created_at`) VALUES
(6, 'Qu\'est-ce que le Bitcoin ?', '<h2>Qu\'est-ce que le Bitcoin ?</h2>\r\n<p>Le Bitcoin est une monnaie numÃ©rique dÃ©centralisÃ©e qui utilise la technologie blockchain pour enregistrer les transactions. Voici les principales caractÃ©ristiques du Bitcoin :</p>\r\n<ul>\r\n    <li>DÃ©centralisÃ© : Pas de banque ou gouvernement.</li>\r\n    <li>SÃ©curisÃ© : Utilisation de cryptographie avancÃ©e.</li>\r\n    <li>Transfrontalier : Transactions mondiales rapides.</li>\r\n</ul>\r\n<p>Voici un exemple de prix actuel du Bitcoin :</p>\r\n<div id=\"bitcoin-price\"></div>\r\n<script>\r\n    async function fetchBitcoinPrice() {\r\n        const response = await fetch(\'https://api.coindesk.com/v1/bpi/currentprice.json\');\r\n        const data = await response.json();\r\n        document.getElementById(\'bitcoin-price\').innerHTML = `<strong>Prix actuel du Bitcoin :</strong> ${data.bpi.USD.rate} USD`;\r\n    }\r\n    fetchBitcoinPrice();\r\n    setInterval(fetchBitcoinPrice, 60000); // Actualise toutes les 60 secondes\r\n</script>\r\n', '2025-01-12 01:30:50'),
(9, 'Graphique Ethereum', '<h2>Graphique de l\'Ã©volution du prix de l\'Ethereum</h2>\r\n<canvas id=\"ethereumChart\" width=\"400\" height=\"200\"></canvas>\r\n<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>\r\n<script>\r\n    async function fetchEthereumData() {\r\n        // Appel API pour rÃ©cupÃ©rer les donnÃ©es Ethereum sur les 30 derniers jours\r\n        const response = await fetch(\'https://api.coingecko.com/api/v3/coins/ethereum/market_chart?vs_currency=usd&days=30\');\r\n        const data = await response.json();\r\n\r\n        // Extraire les dates et prix\r\n        const labels = data.prices.map(price => {\r\n            const date = new Date(price[0]); // La date est au format timestamp\r\n            return `${date.getDate()}/${date.getMonth() + 1}`;\r\n        });\r\n        const prices = data.prices.map(price => price[1]);\r\n\r\n        // CrÃ©er le graphique\r\n        const ctx = document.getElementById(\'ethereumChart\').getContext(\'2d\');\r\n        new Chart(ctx, {\r\n            type: \'line\',\r\n            data: {\r\n                labels: labels,\r\n                datasets: [{\r\n                    label: \'Prix de l\\\'Ethereum (USD)\',\r\n                    data: prices,\r\n                    borderColor: \'rgba(75, 192, 192, 1)\',\r\n                    borderWidth: 2,\r\n                    fill: false,\r\n                }]\r\n            },\r\n            options: {\r\n                responsive: true,\r\n                plugins: {\r\n                    legend: {\r\n                        display: true,\r\n                    }\r\n                },\r\n                scales: {\r\n                    x: {\r\n                        title: {\r\n                            display: true,\r\n                            text: \'Date\',\r\n                        }\r\n                    },\r\n                    y: {\r\n                        title: {\r\n                            display: true,\r\n                            text: \'Prix en USD\',\r\n                        },\r\n                        ticks: {\r\n                            callback: function(value) {\r\n                                return \'$\' + value; // Ajouter le symbole $\r\n                            }\r\n                        }\r\n                    }\r\n                }\r\n            }\r\n        });\r\n    }\r\n\r\n    // Charger les donnÃ©es et gÃ©nÃ©rer le graphique\r\n    fetchEthereumData();\r\n</script>\r\n', '2025-01-12 01:32:43'),
(8, 'Liste des Principales Cryptomonnaies', '<h2>Les principales cryptomonnaies en 2025</h2>\r\n<ul>\r\n    <li>Bitcoin (BTC) : <strong>Le pionnier et leader du marchÃ©</strong></li>\r\n    <li>Ethereum (ETH) : <strong>Plateforme pour les contrats intelligents</strong></li>\r\n    <li>Binance Coin (BNB) : <strong>UtilisÃ© sur la plateforme Binance</strong></li>\r\n    <li>Cardano (ADA) : <strong>Blockchain avec preuve d\'enjeu avancÃ©e</strong></li>\r\n</ul>\r\n<p>Prix actuels :</p>\r\n<div id=\"crypto-prices\"></div>\r\n<script>\r\n    async function fetchCryptoPrices() {\r\n        const response = await fetch(\'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,binancecoin,cardano&vs_currencies=usd\');\r\n        const data = await response.json();\r\n        document.getElementById(\'crypto-prices\').innerHTML = `\r\n            <ul>\r\n                <li>Bitcoin (BTC) : ${data.bitcoin.usd} USD</li>\r\n                <li>Ethereum (ETH) : ${data.ethereum.usd} USD</li>\r\n                <li>Binance Coin (BNB) : ${data.binancecoin.usd} USD</li>\r\n                <li>Cardano (ADA) : ${data.cardano.usd} USD</li>\r\n            </ul>\r\n        `;\r\n    }\r\n    fetchCryptoPrices();\r\n    setInterval(fetchCryptoPrices, 60000); // Actualise toutes les 60 secondes\r\n</script>\r\n', '2025-01-12 01:31:50');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
