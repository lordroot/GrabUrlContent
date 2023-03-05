# GrabUrlContent 

La classe ProxyChecker permet de vérifier la disponibilité d'une liste de serveurs proxy en les testant avec une requête vers un site web donné. Elle utilise l'API cURL de PHP pour effectuer les requêtes en parallèle et récupérer les résultats de manière asynchrone. Les proxy qui renvoient une réponse HTTP dans la plage 2xx sont considérés comme disponibles, tandis que ceux qui renvoient une réponse dans une autre plage sont considérés comme indisponibles.

La classe GrabUrlContent permet de récupérer le contenu d'une page web à partir de son URL. Elle utilise également l'API cURL de PHP pour effectuer les requêtes et récupérer les données de manière asynchrone. Elle prend en charge le traitement des cookies, les requêtes POST et les requêtes personnalisées. Le contenu de la page est renvoyé sous forme de chaîne de caractères.

Ces deux classes sont utiles pour les développeurs qui travaillent sur des projets nécessitant des fonctionnalités de récupération de données à partir de pages web, ou qui ont besoin de tester des serveurs proxy pour leur applicabilité à certaines tâches.
