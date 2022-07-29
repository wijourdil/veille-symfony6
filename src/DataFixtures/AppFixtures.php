<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
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
            ],
            [
                'fullname' => 'John McClain',
                'username' => 'johnmcclain',
                'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'cover' => 'https://placekitten.com/1500/500',
                'avatar' => 'https://avataaars.io/?avatarStyle=Circle&topType=ShortHairTheCaesarSidePart&accessoriesType=Blank&hairColor=PastelPink&facialHairType=BeardLight&facialHairColor=Black&clotheType=BlazerShirt&eyeType=Side&eyebrowType=Default&mouthType=Default&skinColor=Black',
            ],
        ];

        foreach ($userData as $datum) {
            $user = new User();
            $user->setFullname($datum['fullname']);
            $user->setUsername($datum['username']);
            $user->setAvatarPicture($datum['avatar']);
            $user->setCoverPicture($datum['cover']);
            $user->setDescription($datum['description'] ?? null);
            $user->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($user);
        }
    }
}
