<?php

declare(strict_types = 1);

namespace Perks\Apps\Backoffice\Frontend\Command;

use Perks\Backoffice\Courses\Infrastructure\Persistence\ElasticsearchBackofficeCourseRepository;
use Perks\Backoffice\Courses\Infrastructure\Persistence\MySqlBackofficeCourseRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ImportCoursesToElasticsearchCommand extends Command
{
    private MySqlBackofficeCourseRepository         $mySqlRepository;
    private ElasticsearchBackofficeCourseRepository $elasticRepository;

    public function __construct(
        MySqlBackofficeCourseRepository $mySqlRepository,
        ElasticsearchBackofficeCourseRepository $elasticRepository
    ) {
        parent::__construct();

        $this->mySqlRepository   = $mySqlRepository;
        $this->elasticRepository = $elasticRepository;
    }

    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $courses = $this->mySqlRepository->searchAll();

        foreach ($courses as $course) {
            $this->elasticRepository->save($course);
        }
    }
}
