<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $this->seedUsers($manager);

        $manager->flush();
    }

    private function seedUsers(ObjectManager $manager): void
    {
        $userData = [
            [
                'fullname' => 'Sophia W.',
                'username' => 'sophiaw',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'cover' => 'https://placekitten.com/1501/500',
                'avatar' => 'https://avataaars.io/?avatarStyle=Circle&topType=LongHairStraight&accessoriesType=Blank&hairColor=BrownDark&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Default&eyebrowType=Default&mouthType=Default&skinColor=Light',
                'password' => 'password',
            ],
            [
                'fullname' => 'John McClain',
                'username' => 'johnmcclain',
                'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'cover' => 'https://placekitten.com/1500/500',
                'avatar' => 'https://avataaars.io/?avatarStyle=Circle&topType=ShortHairTheCaesarSidePart&accessoriesType=Blank&hairColor=PastelPink&facialHairType=BeardLight&facialHairColor=Black&clotheType=BlazerShirt&eyeType=Side&eyebrowType=Default&mouthType=Default&skinColor=Black',
                'password' => 'password',
            ],
            [
                'fullname' => 'Margot Roby II',
                'username' => 'm.roby2',
                'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'cover' => 'https://placekitten.com/1499/500',
                'avatar' => 'https://avataaars.io/?avatarStyle=Circle&topType=LongHairCurvy&accessoriesType=Blank&hairColor=Platinum&facialHairType=Blank&clotheType=ShirtVNeck&clotheColor=PastelBlue&eyeType=Surprised&eyebrowType=RaisedExcitedNatural&mouthType=Tongue&skinColor=Black',
                'password' => 'password',
            ],
            [
                'fullname' => 'Jean Somon',
                'username' => 'jeanlepoisson',
                'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'cover' => 'https://placekitten.com/1499/501',
                'avatar' => 'https://avataaars.io/?avatarStyle=Circle&topType=ShortHairSides&accessoriesType=Blank&hairColor=Platinum&facialHairType=Blank&clotheType=Overall&clotheColor=White&eyeType=Squint&eyebrowType=RaisedExcitedNatural&mouthType=ScreamOpen&skinColor=Brown',
                'password' => 'password',
            ],
        ];

        foreach ($userData as $datum) {
            $user = new User();
            $user->setFullname($datum['fullname']);
            $user->setUsername($datum['username']);
            $user->setAvatarPicture($datum['avatar']);
            $user->setCoverPicture($datum['cover']);
            $user->setDescription($datum['description'] ?? null);
            $user->setPassword(
                $this->hasher->hashPassword($user, $datum['password'])
            );
            $user->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($user);
        }
    }
}
