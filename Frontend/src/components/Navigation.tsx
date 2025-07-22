import { useState } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { Button } from '@/components/ui/button';
import { Menu, X, ExternalLink } from 'lucide-react';
import ContactForm from '@/components/ContactForm';
import { Dialog, DialogContent, DialogTrigger } from '@/components/ui/dialog';

const Navigation = () => {
  const [isOpen, setIsOpen] = useState(false);
  const [showContactForm, setShowContactForm] = useState(false);
  const location = useLocation();

  const isActive = (path: string) => location.pathname === path;

  const navItems = [
    { href: '/', label: 'Home' },
    { href: '/work', label: 'Work' },
    { href: '/blog', label: 'Blog' },
    { href: '/articles', label: 'Articles' },
  ];

  return (
    <nav className="fixed top-0 w-full z-50 bg-background/80 backdrop-blur-md border-b border-border">
      <div className="container mx-auto px-4">
        <div className="flex items-center justify-between h-16">
          {/* Logo */}
          <Link 
            to="/" 
            className="font-heading text-xl font-bold gradient-text hover:scale-105 transition-transform"
          >
            Roshan Chaturvedi
          </Link>

          {/* Desktop Navigation */}
          <div className="hidden md:flex items-center space-x-8">
            {navItems.map((item) => (
              <Link
                key={item.href}
                to={item.href}
                className={`text-sm font-medium transition-colors hover:text-primary ${
                  isActive(item.href) ? 'text-primary' : 'text-muted-foreground'
                }`}
              >
                {item.label}
              </Link>
            ))}
            <Button 
              variant="outline" 
              size="sm" 
              asChild
              className="hover-lift"
            >
              <a 
                href="https://justacademy.co" 
                target="_blank" 
                rel="noopener noreferrer"
                className="flex items-center gap-2"
              >
                Just Academy
                <ExternalLink className="w-3 h-3" />
              </a>
            </Button>

            {/* Let's Connect Button with Dialog */}
            <Dialog open={showContactForm} onOpenChange={setShowContactForm}>
              <DialogTrigger asChild>
                <Button size="sm" className="bg-gradient-primary hover-lift">
                  Let's Connect
                </Button>
              </DialogTrigger>
              <DialogContent className="max-w-md p-6 rounded-2xl shadow-xl bg-background">
                <ContactForm onClose={() => setShowContactForm(false)} />

              </DialogContent>
            </Dialog>
          </div>

          {/* Mobile Menu Button */}
          <Button
            variant="ghost"
            size="sm"
            className="md:hidden"
            onClick={() => setIsOpen(!isOpen)}
          >
            {isOpen ? <X className="w-5 h-5" /> : <Menu className="w-5 h-5" />}
          </Button>
        </div>

        {/* Mobile Navigation */}
        {isOpen && (
          <div className="md:hidden py-4 border-t border-border animate-fade-in">
            <div className="flex flex-col space-y-4">
              {navItems.map((item) => (
                <Link
                  key={item.href}
                  to={item.href}
                  onClick={() => setIsOpen(false)}
                  className={`text-sm font-medium transition-colors hover:text-primary ${
                    isActive(item.href) ? 'text-primary' : 'text-muted-foreground'
                  }`}
                >
                  {item.label}
                </Link>
              ))}
              <Button 
                variant="outline" 
                size="sm" 
                asChild
                className="w-fit"
              >
                <a 
                  href="https://justacademy.co" 
                  target="_blank" 
                  rel="noopener noreferrer"
                  className="flex items-center gap-2"
                >
                  Just Academy
                  <ExternalLink className="w-3 h-3" />
                </a>
              </Button>

              {/* Mobile: Let's Connect */}
              <Dialog open={showContactForm} onOpenChange={setShowContactForm}>
                <DialogTrigger asChild>
                  <Button size="sm" className="bg-gradient-primary w-fit">
                    Let's Connect
                  </Button>
                </DialogTrigger>
                <DialogContent className="max-w-md p-6 rounded-2xl shadow-xl bg-background">
                  <ContactForm onClose={() => setShowContactForm(false)} />
                </DialogContent>
              </Dialog>
            </div>
          </div>
        )}
      </div>
    </nav>
  );
};

export default Navigation;
