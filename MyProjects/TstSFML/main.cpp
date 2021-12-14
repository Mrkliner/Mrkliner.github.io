#include "i:/SFML-2.5.1/include/SFML/Graphics.hpp"
#include <iostream>
#include <fstream>
#include <windows.h>
#include <string.h>
#include <stdio.h>
#include <string>
using namespace std;
using namespace sf;
int main()
{
    ShowWindow(GetConsoleWindow(), FALSE);
    int score = 0;
    const int one = 1;
    int rlive = 0, torl = 0;
    bool stopx1 = false, opened = true, stopy1 = false, stopx2 = false, stopy2 = false, pointCollected = false, startMove = true;
    sf::RenderWindow window(sf::VideoMode(673, 432), "Packman v14122021_19h58m_d1"/*, Style::Fullscreen*/);
    HWND mainWindow = GetActiveWindow();
    Image hi;
    hi.loadFromFile("Img.png");
    Texture ht;
    ht.loadFromImage(hi);
    Sprite hs;
    hs.setTexture(ht);
    hs.setPosition(0,0);
    Texture point;
    point.loadFromFile("Point.png");
    Sprite spoint;
    spoint.setTexture(point);
    spoint.setPosition(120,120);
    Texture wall;
    wall.loadFromFile("Wall.png");
    Sprite Wall;
    Wall.setTexture(wall);
    Wall.setPosition(220,220);
    Sprite secondWall;
    secondWall.setTexture(wall);
    Vector2f swpos;
    FILE *f;
    f = fopen("scores.gscr", "r");
    fscanf(f, "%d", &score);
    fclose(f);
    swpos.x = 673;
    secondWall.setPosition(250 + rand() % 450,250 + rand() % 450);
    Font font;
    font.loadFromFile("C:/WINDOWS/Fonts/arial.ttf");
    MessageBox(mainWindow, "Game loaded!", "Info", MB_ICONINFORMATION);
    Clock clock, clock1;
    Texture backg;
    backg.loadFromFile("Background.png");
    Sprite backgs;
    backgs.setTexture(backg);
    Sprite wall2;
    wall2.setTexture(wall);
    wall2.setPosition(550, 150);
    bool paused = false;
    Text pauseText;
    Text text;
    int scr = 0;
    while (window.isOpen())
    {
        std::string rl = std::to_string(rlive);
        float timet = clock.getElapsedTime().asMicroseconds();
        float timetr = clock1.getElapsedTime().asMicroseconds();
        clock.restart();
        clock1.restart();
        timet=timet/170;
        timetr=timetr/200;
        clock.restart();
        text.setFont(font);
        string sss = std::to_string(score);
        text.setString("Score: " + sss + "  Lives for restart: " + rl);
        text.setColor(sf::Color::Red);
        Vector2f vec2 = hs.getPosition();
        Vector2f vec3 = Wall.getPosition();
        sf::Event event;
        while (window.pollEvent(event))
        {
            if (event.type == sf::Event::Closed)
                window.close();
            if (Keyboard::isKeyPressed(Keyboard::Escape))
            {
                    window.close();
            }
        }
        FloatRect playerBounds = hs.getGlobalBounds();
        FloatRect pointBounds = spoint.getGlobalBounds();
        FloatRect killBounds = Wall.getGlobalBounds();
        if (playerBounds.intersects(pointBounds))
        {
            score += one;
            pointCollected = true;
            torl += one;
            if (torl == 10)
            {
                torl = 0;
                rlive += one;
            }

        }
        else if (playerBounds.intersects(killBounds) || playerBounds.intersects(wall2.getGlobalBounds()))
        {
            if (rlive <= 0)
            {
                score = 0;
                pointCollected = true;
                hs.setPosition(0,0);
                torl = 0;
            }
            else
            {
                rlive -= 1;
                hs.setPosition(0,0);
                MessageBox (0, "You score saved!", "Info", MB_ICONINFORMATION);
            }
        }
        else if (playerBounds.intersects(secondWall.getGlobalBounds()))
        {
            if (rlive <= 0)
            {
                score = 0;
                pointCollected = true;
                hs.setPosition(0,0);
                torl = 0;
            }
            else
            {
                rlive -= 1;
                hs.setPosition(0,0);
                MessageBox (0, "You score saved!", "Info", MB_ICONINFORMATION);
            }
        }
        if (pointBounds.intersects(killBounds) || pointBounds.intersects(secondWall.getGlobalBounds()) || pointBounds.intersects(wall2.getGlobalBounds()))
        {
            pointCollected = true;
            score = score;
        }
        if (paused == false)
        {
            if (stopx1 == false)
                if (Keyboard::isKeyPressed(Keyboard::Left))
                {
                    hs.move(-0.05*timet, 0); cout << vec2.x <<endl;
                    ht.loadFromFile("ImgRevers.png");
                }
            if (stopx2 == false)
                if (Keyboard::isKeyPressed(Keyboard::Right))
                {
                    hs.move(0.05*timet, 0); cout << vec2.x <<endl;
                    ht.loadFromFile("Img.png");
                }
            if (stopy1 == false)
                if (Keyboard::isKeyPressed(Keyboard::Up))
                {
                    hs.move(0, -0.05*timet); cout << vec2.y <<endl;
                    ht.loadFromFile("ImgU.png");
                }
            if (stopy2 == false)
                if (Keyboard::isKeyPressed(Keyboard::Down))
                {
                    hs.move(0, 0.05*timet); cout << vec2.y <<endl;
                    ht.loadFromFile("ImgD.png");
                }
            if (stopx1 == false)
                if (Keyboard::isKeyPressed(Keyboard::A))
                {
                    hs.move(-0.05*timet, 0); cout << vec2.x <<endl;
                    ht.loadFromFile("ImgRevers.png");
                }
            if (stopx2 == false)
                if (Keyboard::isKeyPressed(Keyboard::D))
                {
                    hs.move(0.05*timet, 0); cout << vec2.x <<endl;
                    ht.loadFromFile("Img.png");
                }
            if (stopy1 == false)
                if (Keyboard::isKeyPressed(Keyboard::W))
                {
                    hs.move(0, -0.05*timet); cout << vec2.y <<endl;
                    ht.loadFromFile("ImgU.png");
                }
            if (stopy2 == false)
                if (Keyboard::isKeyPressed(Keyboard::S))
                {
                    hs.move(0, 0.05*timet); cout << vec2.y <<endl;
                    ht.loadFromFile("ImgD.png");
                }

            if (Keyboard::isKeyPressed(Keyboard::R))
            {
                score = 0;
                rlive = 0;
                torl = 0;
                FILE *f;
                f = fopen("scores.gscr", "r");
                fscanf(f, "%d", &score);
                fclose(f);
                hs.setPosition(0, 0);
                MessageBox(0, "Game restarted!", "Restart game", MB_ICONINFORMATION);
            }
        }
        else
        {
            text.setString("Paused...");
        }
        if (Keyboard::isKeyPressed(Keyboard::F1))
        {
            paused = true;
        }
        if (Keyboard::isKeyPressed(Keyboard::F2))
        {
            paused = false;
            text.setString("Score: " + sss + "  Lives for restart: " + rl);
        }

        if (vec2.x >= 614.7)
        {
            stopx2 = true;
        }
        else {
            stopx2 = false;
        }
        if (vec2.x <= -0.9)
        {
            stopx1 = true;
        }
        else {
            stopx1 = false;
        }
        if (vec2.y <= 0)
        {
            stopy1 = true;
        }
        else
        {
            stopy1 = false;
        }
        if (vec2.y >= 371.699)
        {
            stopy2 = true;
        }
        else
        {
            stopy2 = false;
        }
        ///
        ///
        ///
        if (!paused) {
            if (startMove)
            {
                Wall.move(0, -0.05 * timetr/2);
            }
            else {
                Wall.move(0, 0.05 * timetr/2);
            }
        }
        if (vec3.y <= 0)
        {
            startMove = false;
        }
        if (vec3.y >= 371)
        {
            startMove = true;
        }
        window.clear(Color::Black);
        window.draw(backgs);
        if (pointCollected == false) {
            window.draw(spoint);
        }
        else
        {
            spoint.setPosition(1 + rand() % 300,1 + rand() % 300);
            spoint.setPosition(1 + rand() % 300,1 + rand() % 300);
            spoint.setPosition(1 + rand() % 300,1 + rand() % 300);
            spoint.setPosition(1 + rand() % 300,1 + rand() % 300);
            spoint.setPosition(1 + rand() % 300,1 + rand() % 300);
            window.draw(spoint);
            pointCollected = false;
        }
        window.draw(hs);
        window.draw(Wall);
        window.draw(text);
        window.draw(secondWall);
        window.draw(wall2);
        window.display();
    }

    return 0;
}
