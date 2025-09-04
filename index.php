<?php
// Include database configuration
include_once 'config.php';

// Get database connection
$database = new Database();
$db = $database->getConnection();

// Initialize project object
$project = new Project($db);

// Get all projects
$stmt = $project->getAllProjects();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faisal Ahmed - Portfolio</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>

<header>
    <div class="logo">
        <span class="logo-symbol">⚡</span>
        <span class="logo-text">Faisal Ahmed</span>
    </div>
    <nav class="nav-menu">
        <ul>
            <li><a href="#home" class="nav-link active">Home</a></li>
            <li><a href="#about" class="nav-link">About</a></li>
            <li><a href="#skills" class="nav-link">Skills</a></li>
            <li><a href="#projects" class="nav-link">Projects</a></li>
            <li><a href="#contact" class="nav-link contact-btn">Contact</a></li>
            <li><a href="admin_login.php" class="nav-link" style="color:#ff5e57;font-weight:bold;">Admin?</a></li>
        </ul>
    </nav>
    <div class="mobile-toggle">
        <span></span>
        <span></span>
        <span></span>
    </div>
</header>

<section id="home" class="hero">
    <div class="hero-text">
        <h1>Hello,</h1>
        <h2>I'm <span>Faisal Ahmed</span></h2>
        <h3>Software Developer</h3>
        <div class="buttons">
            <a href="#contact" class="btn">Got a project?</a>
            <a href="#" class="btn-outline">My Resume</a>
        </div>
    </div>
</section>

<section id="skills" class="skills">
    <div class="skills-header">
        <h2>My Skills</h2>
        <p class="skills-subtitle">Technologies I work with</p>
        <div class="skills-divider"></div>
    </div>
    <div class="skills-container">
        <div class="skill-card">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" alt="HTML5" />
            <p>HTML5</p>
        </div>
        <div class="skill-card">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" alt="CSS3" />
            <p>CSS3</p>
        </div>
        <div class="skill-card">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="JavaScript" />
            <p>JavaScript</p>
        </div>
        <div class="skill-card">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP" />
            <p>PHP</p>
        </div>
        <div class="skill-card">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" alt="MySQL" />
            <p>MySQL</p>
        </div>
        <div class="skill-card">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg" alt="React" />
            <p>React</p>
        </div>
        <div class="skill-card">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg" alt="Node.js" />
            <p>Node.js</p>
        </div>
        <div class="skill-card">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg" alt="Git" />
            <p>Git</p>
        </div>
        <div class="skill-card">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nextjs/nextjs-original.svg" alt="Next.js" />
            <p>Next.js</p>
        </div>
        <div class="skill-card">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mongodb/mongodb-original.svg" alt="MongoDB" />
            <p>MongoDB</p>
        </div>
    </div>
</section>

<section id="about" class="about">
    <div class="about-header">
        <h2>About Me</h2>
        <div class="about-divider"></div>
    </div>
    <div class="about-content">
        <div class="about-text">
            <p class="about-intro typing-text" data-text="Hello! I'm Faisal Ahmed, a 3rd-year CSE student passionate about web development, problem-solving, and building real-world projects. I've gained experience in technologies like HTML, CSS, JavaScript, React, Next.js, PHP, and MySQL."></p>
            
            <p class="about-goals typing-text-delayed" data-text="I'm actively improving my competitive programming skills on Codeforces and exploring machine learning to broaden my technical expertise. My goal is to grow as a skilled software engineer and build impactful, high-quality software solutions."></p>
        </div>
        <div class="about-highlights">
            <div class="highlight-card">
                <div class="highlight-icon">🎓</div>
                <h4>Student</h4>
                <p>3rd Year CSE Student</p>
            </div>
            <div class="highlight-card">
                <div class="highlight-icon">💻</div>
                <h4>Developer</h4>
                <p>Full-Stack Web Development</p>
            </div>
            <div class="highlight-card">
                <div class="highlight-icon">🚀</div>
                <h4>Learner</h4>
                <p>Always exploring new technologies</p>
            </div>
        </div>
    </div>
</section>

<section id="projects" class="projects">
    <div class="projects-header">
        <h2>My Projects</h2>
        <p class="projects-subtitle">What I've been working on</p>
        <div class="projects-divider"></div>
    </div>
    <div class="projects-container">
        <?php
        if($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                echo "<div class='project-card' data-aos='fade-up'>";
                echo "    <div class='project-image'>";
                echo "        <img src='{$image_url}' alt='{$title}' />";
                echo "        <div class='project-overlay'>";
                echo "            <div class='project-links'>";
                if(!empty($demo_url) && $demo_url !== '#') {
                    echo "                <a href='{$demo_url}' target='_blank' class='project-link demo-link'>Live Demo</a>";
                }
                if(!empty($github_url) && $github_url !== '#') {
                    echo "                <a href='{$github_url}' target='_blank' class='project-link github-link'>GitHub</a>";
                }
                echo "            </div>";
                echo "        </div>";
                echo "    </div>";
                echo "    <div class='project-content'>";
                echo "        <h3>{$title}</h3>";
                echo "        <p class='project-description'>{$description}</p>";
                echo "        <div class='project-tech'>";
                $tech_array = explode(', ', $technologies);
                foreach($tech_array as $tech) {
                    echo "            <span class='tech-tag'>{$tech}</span>";
                }
                echo "        </div>";
                echo "        <div class='project-status status-{$status}'>";
                echo "            <span class='status-indicator'></span>";
                echo "            " . ucfirst(str_replace('-', ' ', $status));
                echo "        </div>";
                echo "    </div>";
                echo "</div>";
            }
        } else {
            echo "<p class='no-projects'>No projects found.</p>";
        }
        ?>
    </div>
</section>

<footer id="contact">
    <p>Contact me at: <strong>youremail@example.com</strong></p>
    <p>&copy; 2025 Faisal Ahmed Portfolio</p>
</footer>

</body>
</html>
