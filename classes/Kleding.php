<?php
// Set strict types
declare(strict_types=1);

class Kleding
{
    /** @var int|null Het ID van de Nummer */
    private ?int $id;
    private string $naam;

    private string $omschrijving;

    private string $maat;

    private ?string $afbeelding;

    private ?int $prijs;

    /**
     * @param int|null $id
     * @param string $naam
     * @param string $omschrijving
     * @param string $maat
     * @param string|null $afbeelding
     * @param integer|null $prijs
     */
    public function __construct(?int $id, string $naam, string $omschrijving, string $maat, ?string $afbeelding, ?int $prijs)
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->omschrijving = $omschrijving;
        $this->maat = $maat;
        $this->afbeelding = $afbeelding;
        $this->prijs = $prijs;
    }

    /**
     * @param int|null $id
     * @param string $naam
     * @param string $omschrijving
     * @param string $maat
     * @param string|null $afbeelding
     * @param integer|null $prijs
     */


    /**
     * @param int|null $id
     * @param string $naam
     * @param string $omschriving
     * @param string|null $maat
     * @param string|null $afbeelding
     * @param integer $prijs
     */


    public static function getAll(PDO $db): array
    {
        // Voorbereiden van de query
        $stmt = $db->query("SELECT * FROM kleding");

        // Array om personen op te slaan
        $kledings = [];

        // Itereren over de resultaten en personen toevoegen aan de array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $kleding = new Kleding(
                $row['id'],
                $row['naam'],
                $row['omschrijving'],
                $row['maat'],
                $row['afbeelding'],
                $row['prijs']
            );
            $kledings[] = $kleding;
        }

        // Retourneer array met personen
        return $kledings;
    }

    public static function findById(PDO $db, int $id): ?Kleding
    {
        // Voorbereiden van de query
        $stmt = $db->prepare("SELECT * FROM persoon WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Retourneer een persoon als gevonden, anders null
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new Kleding(
                $row['id'],
                $row['naam'],
                $row['omschrijving'],
                $row['maat'],
                $row['afbeelding'],
                $row['prijs']
            );
        } else {
            return null;
        }
    }    // Methode om een nieuwe persoon toe te voegen aan de database

    public function save(PDO $db): void
    {
        // Voorbereiden van de query
        $stmt = $db->prepare("INSERT INTO kleding (naam, omschrijving,maat, afbeelding, prijs) VALUES (:naam, :omschrijving,:maat, :afbeelding, :prijs)");
        $stmt->bindParam(':naam', $this->naam);
        $stmt->bindParam(':omschrijving', $this->omschrijving);
        $stmt->bindParam(':maat', $this->maat);
        $stmt->bindParam(':afbeelding', $this->afbeelding);
        $stmt->bindParam(':prijs', $this->prijs);
        $stmt->execute();
    }

    public static function findByAchternaam(PDO $db, string $omschrijving, $naam): array
    {
        //Zet de achternaam eerst om naar lowercase letters
        $Titel = strtolower($omschrijving);

        // Voorbereiden van de query
        $stmt = $db->prepare("SELECT * FROM kleding WHERE LOWER(omschrijving) LIKE :naam");

        // Voeg wildcard toe aan de achternaam
        $omschrijving = "%$omschrijving%";

        // Bind de achternaam aan de query en voer deze uit
        $stmt->bindParam(':omschrijving', $omschrijving);
        $stmt->execute();

        // Array om personen op te slaan
        $kledings = [];

        // Itereren over de resultaten en personen toevoegen aan de array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $personen[] = new Kleding(
                $row['id'],
                $row['naam'],
                $row['omschrijving'],
                $row['maat'],
                $row['afbeelding'],
                $row['prijs']
            );
        }

        // Retourneer array met personen
        return
            $kledings;

    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNaam(): string
    {
        return $this->naam;
    }

    /**
     * @param string $naam
     */
    public function setNaam(string $naam): void
    {
        $this->naam = $naam;
    }

    /**
     * @return string
     */
    public function getOmschrijving(): string
    {
        return $this->omschrijving;
    }

    /**
     * @param string $omschrijving
     */
    public function setOmschrijving(string $omschrijving): void
    {
        $this->omschrijving = $omschrijving;
    }

    /**
     * @return string
     */
    public function getMaat(): string
    {
        return $this->maat;
    }

    /**
     * @param string $maat
     */
    public function setMaat(string $maat): void
    {
        $this->maat = $maat;
    }

    /**
     * @return string|null
     */
    public function getAfbeelding(): ?string
    {
        return $this->afbeelding;
    }

    /**
     * @param string|null $afbeelding
     */
    public function setAfbeelding(?string $afbeelding): void
    {
        $this->afbeelding = $afbeelding;
    }

    /**
     * @return int|null
     */
    public function getPrijs(): ?int
    {
        return $this->prijs;
    }

    /**
     * @param int|null $prijs
     */
    public function setPrijs(?int $prijs): void
    {
        $this->prijs = $prijs;
    }

    /**
     * @return int|null
     */

}
