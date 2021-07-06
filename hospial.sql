-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Dic 13, 2018 alle 19:54
-- Versione del server: 5.6.38
-- Versione PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospial`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `FAQ`
--

CREATE TABLE `FAQ` (
  `id` int(11) NOT NULL,
  `domanda` text NOT NULL,
  `risposta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `Messaggi`
--

CREATE TABLE `Messaggi` (
  `idmessaggi` int(11) NOT NULL,
  `mittente` int(11) NOT NULL,
  `destinatario` int(11) NOT NULL,
  `messaggio` text NOT NULL,
  `letto` enum('0','1') NOT NULL DEFAULT '0',
  `data` date NOT NULL,
  `orario` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Messaggi`
--

INSERT INTO `Messaggi` (`idmessaggi`, `mittente`, `destinatario`, `messaggio`, `letto`, `data`, `orario`) VALUES
(12, 5, 8, 'Salve volevo sapere se fosse possibile cambiare il giorno della mia prestazione', '1', '2018-10-25', '11:00:00'),
(13, 8, 5, 'Non è possibile spostare la visita prenotata.\r\nMi dispiace:\r\nLuca - Lo Staff', '0', '2018-10-25', '11:05:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `Prenotazione`
--

CREATE TABLE `Prenotazione` (
  `ipprenotazione` int(11) NOT NULL,
  `idpaziente` int(11) NOT NULL,
  `idprestazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Prenotazione`
--

INSERT INTO `Prenotazione` (`ipprenotazione`, `idpaziente`, `idprestazione`) VALUES
(5, 5, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `Prestazione`
--

CREATE TABLE `Prestazione` (
  `idprestazione` int(11) NOT NULL,
  `idreparto` int(11) NOT NULL,
  `descrizione` varchar(25) NOT NULL,
  `orario` time NOT NULL,
  `data` date NOT NULL,
  `prescrizioni` varchar(25) NOT NULL,
  `tipoprestazione` enum('visita','esame','intervento') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Prestazione`
--

INSERT INTO `Prestazione` (`idprestazione`, `idreparto`, `descrizione`, `orario`, `data`, `prescrizioni`, `tipoprestazione`) VALUES
(4, 6, 'controllo cuore', '12:00:00', '2018-10-10', 'no colazione', 'visita'),
(5, 9, 'rimozione cataratta', '17:00:00', '2018-10-16', 'non bere', 'intervento');

-- --------------------------------------------------------

--
-- Struttura della tabella `Reparto`
--

CREATE TABLE `Reparto` (
  `idreparto` int(11) NOT NULL,
  `idmedico` int(11) NOT NULL,
  `nomereparto` enum('cardiologia','gastroenterologia','oculistica','odontoiatria','radiologia') NOT NULL,
  `descrizione` text NOT NULL,
  `recapiti` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Reparto`
--

INSERT INTO `Reparto` (`idreparto`, `idmedico`, `nomereparto`, `descrizione`, `recapiti`) VALUES
(6, 1, 'cardiologia', 'piano 1 stanza 1', '071001'),
(7, 2, 'gastroenterologia', 'piano 2 stanza 2', '071002'),
(8, 3, 'oculistica', 'stanza 3 piano 3', '071003'),
(9, 4, 'oculistica', 'stanza 4 piano 3', '071004');

-- --------------------------------------------------------

--
-- Struttura della tabella `Struttura`
--

CREATE TABLE `Struttura` (
  `idstruttura` int(11) NOT NULL,
  `latitudine` varchar(25) NOT NULL,
  `longitudine` varchar(25) NOT NULL,
  `recapito` varchar(25) NOT NULL,
  `reparto` enum('cardiologia','gastroenterologia','oculistica','odontoiatria','radiologia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Struttura`
--

INSERT INTO `Struttura` (`idstruttura`, `latitudine`, `longitudine`, `recapito`, `reparto`) VALUES
(1, '', '', '071001', 'cardiologia');

-- --------------------------------------------------------

--
-- Struttura della tabella `Utenti`
--

CREATE TABLE `Utenti` (
  `idutente` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `ruolo` enum('admin','medico','paziente','staff') NOT NULL,
  `nome` varchar(25) NOT NULL,
  `cognome` varchar(25) NOT NULL,
  `sesso` enum('M','F') NOT NULL,
  `numero telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Utenti`
--

INSERT INTO `Utenti` (`idutente`, `username`, `password`, `email`, `ruolo`, `nome`, `cognome`, `sesso`, `numero telefono`) VALUES
(1, 'medico1', 'medico1', 'medico1@prova.it', 'medico', 'marco', 'rossi', 'M', '3402221344'),
(2, 'medico2', 'medico2', 'medico2@prova.it', 'medico', 'paola', 'rossi', 'F', '3456789432'),
(3, 'medico3', 'medico3', 'medico3@prova.it', 'medico', 'caio', 'sempronio', 'M', '3678904456'),
(4, 'medico4', 'medico4', 'medico4@prova.it', 'medico', 'mario', 'neri', 'M', '3456783456'),
(5, 'paziente1', 'paziente1', 'paziente1@prova.it', 'paziente', 'marco', 'bianchi', 'M', '3359987656'),
(6, 'paziente2', 'paziente2', 'paziente2@prova.it', 'paziente', 'matteo ', 'verdi', 'M', '334567990'),
(7, 'paziente3', 'paziente3', 'paziente3@prova.it', 'paziente', 'mirco', 'gialli', 'M', '3445334567'),
(8, 'staff1', 'staff1', 'staff1@prova.it', 'staff', 'tizio', 'maledetto', 'M', '355678998');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `FAQ`
--
ALTER TABLE `FAQ`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `Messaggi`
--
ALTER TABLE `Messaggi`
  ADD PRIMARY KEY (`idmessaggi`),
  ADD KEY `messaggiomittente` (`mittente`),
  ADD KEY `messaggiodestinatario` (`destinatario`);

--
-- Indici per le tabelle `Prenotazione`
--
ALTER TABLE `Prenotazione`
  ADD PRIMARY KEY (`ipprenotazione`),
  ADD KEY `prestazione` (`idprestazione`),
  ADD KEY `utente` (`idpaziente`);

--
-- Indici per le tabelle `Prestazione`
--
ALTER TABLE `Prestazione`
  ADD PRIMARY KEY (`idprestazione`),
  ADD KEY `reparto` (`idreparto`);

--
-- Indici per le tabelle `Reparto`
--
ALTER TABLE `Reparto`
  ADD PRIMARY KEY (`idreparto`),
  ADD KEY `medico1` (`idmedico`);

--
-- Indici per le tabelle `Struttura`
--
ALTER TABLE `Struttura`
  ADD PRIMARY KEY (`idstruttura`);

--
-- Indici per le tabelle `Utenti`
--
ALTER TABLE `Utenti`
  ADD PRIMARY KEY (`idutente`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `FAQ`
--
ALTER TABLE `FAQ`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Messaggi`
--
ALTER TABLE `Messaggi`
  MODIFY `idmessaggi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `Prenotazione`
--
ALTER TABLE `Prenotazione`
  MODIFY `ipprenotazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `Prestazione`
--
ALTER TABLE `Prestazione`
  MODIFY `idprestazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `Reparto`
--
ALTER TABLE `Reparto`
  MODIFY `idreparto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `Struttura`
--
ALTER TABLE `Struttura`
  MODIFY `idstruttura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `Utenti`
--
ALTER TABLE `Utenti`
  MODIFY `idutente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Messaggi`
--
ALTER TABLE `Messaggi`
  ADD CONSTRAINT `messaggiodestinatario` FOREIGN KEY (`destinatario`) REFERENCES `Utenti` (`idutente`),
  ADD CONSTRAINT `messaggiomittente` FOREIGN KEY (`mittente`) REFERENCES `Utenti` (`idutente`);

--
-- Limiti per la tabella `Prenotazione`
--
ALTER TABLE `Prenotazione`
  ADD CONSTRAINT `prestazione` FOREIGN KEY (`idprestazione`) REFERENCES `Prestazione` (`idprestazione`),
  ADD CONSTRAINT `utente` FOREIGN KEY (`idpaziente`) REFERENCES `Utenti` (`idutente`);

--
-- Limiti per la tabella `Prestazione`
--
ALTER TABLE `Prestazione`
  ADD CONSTRAINT `reparto` FOREIGN KEY (`idreparto`) REFERENCES `Reparto` (`idreparto`);

--
-- Limiti per la tabella `Reparto`
--
ALTER TABLE `Reparto`
  ADD CONSTRAINT `medico1` FOREIGN KEY (`idmedico`) REFERENCES `Utenti` (`idutente`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
