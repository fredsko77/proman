<?php

namespace App\DataFixtures;

use App\Entity\CheckListItem;
use Faker\Factory;
use App\Entity\Utilisateur;
use App\Entity\Projet;
use App\Entity\FileType;
use App\Utils\FakerTrait;
use Cocur\Slugify\Slugify;
use App\Entity\ProjectFlow;
use App\Entity\ProjectMember;
use App\Entity\TypeProjet;
use App\Repository\ProjectFlowsRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    use FakerTrait;

    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $slugger = new Slugify;
        $userList = [];
        $projectTypes = [];

        # Users
        for ($i = 0; $i < random_int(600, 1000); $i++) {
            $user = new Utilisateur;

            $user->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setRegisteredAt($this->setDateTimeBetween('-3 years', '-1 year'))
                ->setUpdatedAt($this->setDateTimeBetween('-1 year'))
                ->setEmail($faker->email())
                ->setPassword($this->hasher->hashPassword($user, 'password'))
                ->setConfirm(true)
                ->setRoles($faker->randomElement(Utilisateur::roles()))
                ->setUsername($faker->userName());

            $manager->persist($user);
            $userList[$i] = $user;
        }

        # ProjectTypes
        foreach ($this->getProjectTypes() as $k => $t) {
            $type = new TypeProjet;

            $type->setName($t['name'])
                ->setDescription($t['description'])
                ->setIcon($t['icon']);

            $manager->persist($type);
            $projectTypes[$k] = $type;
        }

        # Projects
        for ($i = 0; $i < random_int(500, 1000); $i++) {
            $project = new Projet;
            $name = ucfirst($faker->words(random_int(2, 5), true));
            $members = $faker->randomElements($userList, random_int(1, 5));
            $owner = $this->randomElement($members);

            $project->setName($name)
                ->setDescription($faker->sentences(random_int(1, 4), true))
                ->setSlug($slugger->slugify($name))
                ->setCreatedAt($this->setDateTimeBetween('-1 year'))
                ->setUpdatedAt($this->setDateTimeAfter($project->getCreatedAt()))
                ->setBudget($faker->randomFloat(2, 500, 100000))
                ->setType($this->randomElement($projectTypes));

            // # ProjectMembers
            // foreach ($members as $k => $member) {
            //     $member = new ProjectMember;

            //     $member->setIsOwner($project->getCreatedBy() === $member)
            //         ->setMembershipDate($this->setDateTimeAfter($project->getCreatedAt()))
            //         ->setUser($owner)
            //         ->setProject($project);

            //     # ProjectFlows
            //     for ($f = 0; $f < random_int(0, 3); $f++) {
            //         $flow = new ProjectFlow;

            //         $flow->setProject($project)
            //             ->setIsRecurrent($f % 2)
            //             ->setAmount($faker->randomFloat(2, 0, ($faker->randomFloat(2, 0.01, 0.1) * $project->getBudget())))
            //             ->setType($this->randomElement(ProjectFlow::types()));

            //         $member->addProjectFlow($flow);
            //     }

            //     # CheckListItems
            //     for ($c = 0; $c < random_int(1, 4); $c++) {
            //         $listItem = new CheckListItem();

            //         $listItem->setReporter($member->getUser())
            //             ->setName($faker->words(random_int(1, 4), true))
            //             ->setCreatedAt($this->setDateTimeAfter($project->getCreatedAt()))
            //             ->setUpdatedAt($this->setDateTimeAfter($listItem->getCreatedAt()))
            //             ->setIsDone($c % random_int(1, 3))
            //             ->setCompletedAt($listItem->isIsDone() ? $this->setDateTimeAfter($listItem->getCreatedAt()) : null);

            //         $listItem->setProject($project);
            //         $manager->persist($listItem);
            //     }

            //     $member->setProject($project);
            //     $manager->persist($member);
            // }

            $manager->persist($project);
        }

        # FileTypes
        foreach ($this->getFileTypes() as $k => $fileType) {
            $type = new FileType;

            $type->setIcon($fileType['icon'])
                ->setName($fileType['name'])
                ->setExtensions($fileType['extensions']);

            $manager->persist($type);
        }

        $manager->flush();
    }

    /**
     * Return an array of file types
     *
     * @return array
     */
    private function getFileTypes(): array
    {
        return [
            // Tableur
            [
                'name' => 'Fichier tableur',
                'icon' => 'file-excel',
                'extensions' => ['ods', 'xls', 'xlsx',],
            ],
            // Texte
            [
                'name' => 'Fichier texte',
                'icon' => 'file-text',
                'extensions' => ['odt', 'doc', 'docx', 'txt',]
            ],
            // Code
            [
                'name' => 'Fichier de code',
                'icon' => 'file-code',
                'extensions' => [
                    'log', 'xml', 'twig', 'html', 'php', 'js', 'md', 'yaml', 'yml', 'json', 'env', 'css', 'scss', 'sass', 'sql', 'sh', 'py', 'htaccess', 'conf',
                ],
            ],
            // Image
            [
                'name' => 'Images',
                'icon' => 'file-image',
                'extensions' => [
                    'jpg', 'jpeg', 'png', 'svg', 'gif',
                ],
            ],
            // Pdf
            [
                'name' => 'Fichier pdf',
                'icon' => 'file-pdf',
                'extensions' => [
                    'pdf',
                ],
            ],
            // Archive
            [
                'name' => 'Fichier archive',
                'icon' => 'file-zip',
                'extensions' => [
                    'zip',
                ],
            ],
            // Présentations
            [
                'name' => 'Support slides',
                'icon' => 'file-slides',
                'extensions' => [
                    'odp', 'ppt', 'pptx',
                ],
            ],
            // Vidéos
            [
                'name' => 'Vidéos',
                'icon' => 'file-play',
                'extensions' => [
                    'avi', 'mp4', 'mkv', 'flv',
                ],
            ],
            // Audios
            [
                'name' => 'Audios',
                'icon' => 'file-music',
                'extensions' => [
                    'mp3', 'aac', 'flac', 'ogg',
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    private function getProjectTypes(): array
    {
        return [
            [
                'name' => 'Faire des économies',
                'description' => null,
                'icon' => 'piggy-bank'
            ],
            [
                'name' => 'Acheter un bien immobilier',
                'description' => null,
                'icon' => 'house'
            ],
            [
                'name' => 'Acheter une voiture',
                'description' => null,
                'icon' => 'car-front-fill'
            ],
            [
                'name' => 'Acheter des cadeaux',
                'description' => null,
                'icon' => 'gift'
            ],
            [
                'name' => 'Partir en voyage',
                'description' => null,
                'icon' => 'airplane-engines'
            ],
            [
                'name' => 'Faire des travaux',
                'description' => null,
                'icon' => 'tools'
            ],
            [
                'name' => 'Divers',
                'description' => null,
                'icon' => 'three-dots'
            ],
        ];
    }
}
