Informatica Biomedica
=====================
Click [here](http://localhost/informatica_biomedica/Portale/view/HomePage.php) to see the project.



Questo progetto è stato realizzato grazie alla collaborazione tra l'Università degli Studi Roma Tre e l'Istituto C.S.S. Mendel. 
In particolare il progetto è stato sviluppato da:

- Lorenzo Martucci;
- Claudia Raponi;
- Luca Tomaselli;

Nel contesto del corso di Informatica Biomedica, durante l’anno accademico 2013/2014 per il corso di Laurea Magistrale in Ingegneria Informatica. 

------------------------------------------------------------------------------------------------------------------------

Il portale rappresenta uno strumento di interazione con i dati clinici relativi ai pazienti affetti dalla sindrome di Joubert. L'obiettivo principale è stato quello di implementare un portale web server che permettesse di realizzare un archivio della clinica delle persone affette da tale sindrome analizzata attraverso sequenziamento. Lo scopo finale mira quindi ad agevolare l'associazione genotipo/fenotipo dei pazienti in screening presso l’Istituto C.S.S Mendel. Il portale offre quindi un mezzo per facilitare l’individuazione di varianti genetiche patogenetiche.

Il portale può essere utilizzato sia da utenti generici, che vogliono intraprendere delle ricerche consultative interrogando l’archivio con opportune query, sia da utenti aventi maggiori competenze. Questi ultimi, gli amministratori dell’archivio, potranno utilizzarlo, sia per effettuare ricerche ma anche per inserire, modificare e cancellare i campioni presenti nell’archivio.

Gli utenti amministratori dovranno essere registrati preventivamente all’interno del database per permettere il loro riconoscimento durante la fase di autenticazione. Per fare questo è possibile sia caricare i dati dell’amministratore (nome e password) attraverso lo script clinical_data.sql, modificando opportunamente la seguente istruzione:

	INSERT INTO `administrators` (`name`, `password`) VALUES
	('claudia', 'claudia'),
	('lorenzo', 'lorenzo'),
	('luca', 'luca'),
	('tommaso', 'tommaso');

Oppure aggiungere l’amministratore e le relative credenziali direttamente attraverso il database, accessibile da: [http://localhost/phpmyadmin](http://localhost/phpmyadmin). In questo caso sarà necessario aggiungere i dati dell’utente amministratore, all’interno della tabella administrators, attraverso il comando Inserisci.


