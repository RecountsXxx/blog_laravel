I made an example of a blog where you can create your own posts, comment, complain about posts and comments, view posts, and all this can be managed through the admin panel.
<h2>Deployment</h2>
<ul>
  <li>Start script "setup.sh" command: <code>/bin/bash/setup.sh</code> and wait</li>
  <li>For other runs, enter the command: <code>docker-compose up -d</code></li>
</ul>
<h2>About</h2>

Technologies Used

    Front-end public: ReactJs, Bootstrap
    Front-end admin: VueJs, Bootstrap
    Back-end: PHP, Laravel, RestFUll, Microservices, Nginx, Redis, Supervisor, Docker
    Database: MySQL
    Socket service: NodeJS, SocketIO
    
Features for Users' Website
User Interactions

  Search Posts: Users can easily search for posts using keywords, tags, or categories to find the content they are interested in.
    Create Posts: Users have the ability to create their own posts, sharing their thoughts, images, or videos with the community.
    Delete Posts: Users can delete their own posts if they choose to remove their content from the website.
    Like Posts: Allows users to express their appreciation for a post, helping to promote popular content within the community.
    Write Comments on Posts: Users can engage with content creators and the community by writing comments on posts.
    Report Posts and Comments: Provides users with the ability to report inappropriate or offensive posts and comments to the website moderators for review.
    Pagination: Enhances user experience by organizing content into multiple pages, making it easier to browse through posts.
    Real-time Messaging from Admin Panel to Users' Websites: Enables direct communication from the website administrators to users, allowing for announcements, alerts, and personalized messages to be sent in real time.
    System Bans for Users: To maintain a healthy community environment, users who violate website policies can be temporarily or permanently banned from the website.
    Swagger Documentation: Comprehensive documentation of the website’s API, facilitating easier integration and development by providing a clear overview of available endpoints, parameters, and responses.

Admin Features

  CRUD Operations for All: Admins have complete control over the content with the ability to create, read, update, and delete (CRUD) posts, comments, and user accounts.
    Send Messages from Admin Panel to Users' Website: This feature allows admins to communicate directly with users through their website, whether for notifications, updates, or individual messages.
    Statistics (Dashboard): A powerful dashboard that provides admins with real-time statistics about user engagement, post popularity, and overall website activity, aiding in strategic decision-making.
    Moderating, Ban Users When Reported: Admins have the authority to moderate content and user behavior, including banning users based on reports and ensuring compliance with website guidelines.

These features together create a robust and engaging environment for users, encouraging interaction and participation while providing admins with the tools needed to manage the community effectively.


    

