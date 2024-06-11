<?php
// Set strict types
declare(strict_types=1);

class Nummer
{
    /** @var int|null Het ID van de Nummer */
    private ?int $ID;

    private string $AlbumID;

    private string $Titel;

    private ?string $Duur;

    private ?string $URL;

    /**
     * @param int|null $ID
     * @param string $AlbumID
     * @param string $Titel
     * @param string|null $Duur
     * @param string|null $URL
     */
    public function __construct(?int $ID, string $AlbumID, string $Titel, ?string $Duur, ?string $URL)
    {
        $this->ID = $ID;
        $this->AlbumID = $AlbumID;
        $this->Titel = $Titel;
        $this->Duur = $Duur;
        $this->URL = $URL;
    }

    public static function getAll(PDO $db): array
    {
        // Voorbereiden van de query
        $stmt = $db->query("SELECT * FROM nummer");

        // Array om personen op te slaan
        $Nummers = [];

        // Itereren over de resultaten en personen toevoegen aan de array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $Nummer = new Nummer(
                $row['ID'],
                $row['AlbumID'],
                $row['Titel'],
                $row['Duur'],
                $row['URL'],
            );
            $Nummers[] = $Nummer;
        }

        // Retourneer array met personen
        return $Nummers;
    }

    public static function findById(PDO $db, int $id): ?Nummer
    {
        // Voorbereiden van de query
        $stmt = $db->prepare("SELECT * FROM persoon WHERE id = :id");
        $stmt->bindParam(':id', $ID);
        $stmt->execute();

        // Retourneer een persoon als gevonden, anders null
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new Nummer(
                $row['ID'],
                $row['AlbumID'],
                $row['Titel'],
                $row['Duur'],
                $row['URL'],
            );
        } else {
            return null;
        }
    }

    public static function findByAchternaam(PDO $db, string $Titel, $Nummer): array
    {
        //Zet de achternaam eerst om naar lowercase letters
        $Titel = strtolower($Titel);

        // Voorbereiden van de query
        $stmt = $db->prepare("SELECT * FROM nummer WHERE LOWER(Titel) LIKE :AlbumID");

        // Voeg wildcard toe aan de achternaam
        $Titel = "%$Titel%";

        // Bind de achternaam aan de query en voer deze uit
        $stmt->bindParam(':Titel', $Titel);
        $stmt->execute();

        // Array om personen op te slaan
        $personen = [];

        // Itereren over de resultaten en personen toevoegen aan de array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $personen[] = new Nummer(
                $row['ID'],
                $row['AlbumID'],
                $row['Titel'],
                $row['Duur'],
                $row['URL'],

            );
        }

        // Retourneer array met personen
        return
            $Nummer;

    }

    /**
     * @return int|null
     */
    public function getID(): ?int
    {
        return $this->ID;
    }

    /**
     * @param int|null $ID
     */
    public function setID(?int $ID): void
    {
        $this->ID = $ID;
    }

    /**
     * @return string
     */
    // Methode om een nieuwe persoon toe te voegen aan de database
    public function save(PDO $db): void
    {
        // Voorbereiden van de query
        $stmt = $db->prepare("INSERT INTO persoon (AlbumID, Titel, Duur, URL) VALUES (:AlbumID, :Titel, :Duur, :URL)");
        $stmt->bindParam(':AlbumID', $this->AlbumID);
        $stmt->bindParam(':Titel', $this->Titel);
        $stmt->bindParam(':Duur', $this->Duur);
        $stmt->bindParam(':URL', $this->URL);
        $stmt->execute();
    }


    public function getAlbumID(): string
    {
        return $this->AlbumID;
    }

    /**
     * @param string $AlbumID
     */
    public function setAlbumID(string $AlbumID): void
    {
        $this->AlbumID = $AlbumID;
    }

    /**
     * @return string
     */
    public function getTitel(): string
    {
        return $this->Titel;
    }

    /**
     * @param string $Titel
     */
    public function setTitel(string $Titel): void
    {
        $this->Titel = $Titel;
    }

    /**
     * @return string|null
     */
    public function getDuur(): ?string
    {
        return $this->Duur;
    }

    /**
     * @param string|null $Duur
     */
    public function setDuur(?string $Duur): void
    {
        $this->Duur = $Duur;
    }

    /**
     * @return string|null
     */
    public function getURL(): ?string
    {
        return $this->URL;
    }

    /**
     * @param string|null $URL
     */
    public function setURL(?string $URL): void
    {
        $this->URL = $URL;
    }
}