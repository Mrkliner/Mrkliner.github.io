using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
//using System.Linq;
using System.Text;
//using System.Threading.Tasks;
using System.Windows.Forms;

namespace Мои_заметки
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            saveFileDialog1.ShowDialog();
            File.WriteAllText(saveFileDialog1.FileName + "", richTextBox1.Text);
        }

        private void button4_Click(object sender, EventArgs e)
        {
            fontDialog1.ShowDialog();
            richTextBox1.Font = fontDialog1.Font;
        }

        private void button2_Click(object sender, EventArgs e)
        {
            openFileDialog1.ShowDialog();
            richTextBox1.Text = File.ReadAllText(openFileDialog1.FileName);
        }

        private void button3_Click(object sender, EventArgs e)
        {
            richTextBox1.Text += Environment.NewLine + DateTime.UtcNow + Environment.NewLine;
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            
        }

    }
}
